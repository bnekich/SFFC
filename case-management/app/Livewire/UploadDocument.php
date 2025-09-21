<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use PhpOffice\PhpSpreadsheet\IOFactory as SpreadsheetIOFactory;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Log;

class UploadDocument extends Component
{
    use WithFileUploads;

    public $file;
    public $allowedTypes = ['pdf', 'doc', 'docx', 'xlsx', 'jpg', 'png', 'txt', 'csv', 'odt'];
    public $maxSize = 10240; // 10MB in KB

    public function rules()
    {
        return [
            'file' => 'required|file|max:' . $this->maxSize . '|mimes:' . implode(',', $this->allowedTypes),
        ];
    }

    public function updatedFile()
    {
        // Validate file as soon as it's selected
        $this->validateOnly('file');
        Log::info('File updated: ' . ($this->file ? $this->file->getClientOriginalName() : 'No file'));
    }

    public function uploadFile()
    {
        try {
            Log::info('uploadFile method called');
            $this->validate();

            if (!$this->file) {
                Log::error('No file selected in uploadFile method');
                throw new \Exception('No file selected.');
            }

            Log::info('Uploading file: ' . $this->file->getClientOriginalName());

            $originalName = $this->file->getClientOriginalName();
            $mimeType = $this->file->getMimeType();
            $size = $this->file->getSize();
            $localPath = $this->file->getRealPath();

            // Extract text based on file type
            $content = $this->extractText($localPath, $mimeType);

            // Store file in Digital Ocean Spaces and save metadata to database
            $path = $this->file->store('documents', 'spaces');
            Document::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'name' => $originalName,
                'path' => $path,
                'mime_type' => $mimeType,
                'size' => $size,
                'type' => $this->file->extension(),
                'content' => $content,
            ]);

            session()->flash('message', 'File uploaded successfully!');
            $this->reset('file');
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            session()->flash('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }

    protected function extractText($filePath, $mimeType)
    {
        try {
            if (str_contains($mimeType, 'pdf')) {
                return Pdf::getText($filePath, null, ['pdftotext_path' => '/usr/bin/pdftotext']);
            } elseif (in_array($mimeType, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text'])) {
                $phpWord = IOFactory::load($filePath);
                // Use a more robust text extraction method
                $text = '';
                $sections = $phpWord->getSections();
                foreach ($sections as $section) {
                    $elements = $section->getElements();
                    foreach ($elements as $element) {
                        if (method_exists($element, 'getText')) {
                            $text .= $element->getText() . ' ';
                        }
                    }
                }
                return trim($text);
            } elseif (in_array($mimeType, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) {
                $spreadsheet = SpreadsheetIOFactory::load($filePath);
                $worksheet = $spreadsheet->getActiveSheet();
                return implode(' ', array_map('implode', $worksheet->toArray()));
            } elseif (str_contains($mimeType, 'text/plain')) {
                return file_get_contents($filePath);
            } elseif (str_contains($mimeType, 'csv')) {
                $handle = fopen($filePath, 'r');
                $content = '';
                while (($row = fgetcsv($handle)) !== false) {
                    $content .= implode(' ', $row) . "\n";
                }
                fclose($handle);
                return trim($content);
            } else {
                Log::warning('Unsupported file type: ' . $mimeType);
                return null;
            }
        } catch (\Exception $e) {
            Log::error('Text extraction failed for ' . $mimeType . ': ' . $e->getMessage());
        }
        return null;
    }

    public function render()
    {
        return view('livewire.upload-document');
    }
}
