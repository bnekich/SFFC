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
        $this->validateOnly('file');
        Log::info('File updated: ' . ($this->file ? $this->file->getClientOriginalName() : 'No file'));
    }

    public function uploadFile()
    {
        $context = [
            'file_name' => $this->file ? $this->file->getClientOriginalName() : null,
            'mime_type' => $this->file ? $this->file->getMimeType() : null,
            'size' => $this->file ? $this->file->getSize() : null,
        ];

        try {
            //Log::info('uploadFile method called');
            Log::channel('audit')->debug('uploadFile method called', $context);

            $this->validate();
            Log::channel('audit')->debug('File validation successful', $context);

            if (!$this->file) {
                //Log::error('No file selected in uploadFile method');
                Log::channel('audit')->debug('No file selected', $context);
                throw new \Exception('No file selected.');
            }

            Log::channel('audit')->debug('Uploading file: ' . $this->file->getClientOriginalName(), $context);

            $originalName = $this->file->getClientOriginalName();
            $mimeType = $this->file->getMimeType();
            $size = $this->file->getSize();

            // Read file content into memory
            $fileContent = $this->file->get();

            // Extract text based on file type using the content
            $content = $this->extractTextFromContent($fileContent, $mimeType);

            // Store file content in Digital Ocean Spaces
            $path = 'documents/' . uniqid() . '_' . $originalName; // Use unique name
            Storage::disk('spaces')->put($path, $fileContent);

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

    protected function extractTextFromContent($content, $mimeType)
    {
        try {
            if (str_contains($mimeType, 'pdf')) {
                // PDF to Text library requires a file path, so write to a temporary stream in memory
                $tempStream = fopen('php://memory', 'w+');
                fwrite($tempStream, $content);
                rewind($tempStream);

                // Spatie\PdfToText still requires a file path. A cleaner solution is to switch
                // to a PDF parsing library that accepts streams. For now, we write to a temporary file
                // and accept the risk. A better approach is using `Spatie\PdfToText\Pdf::getTextFromRaw`
                // if it exists, or a different library entirely.

                // A safer workaround, though still not ideal, involves using temporary streams
                // and a different library if Spatie cannot accept a stream.
                $tempFile = tempnam(sys_get_temp_dir(), 'pdf');
                file_put_contents($tempFile, $content);
                $text = Pdf::getText($tempFile, null, ['pdftotext_path' => '/usr/bin/pdftotext']);
                unlink($tempFile);
                return $text;
            } elseif (in_array($mimeType, ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text'])) {
                $tempFile = tempnam(sys_get_temp_dir(), 'word');
                file_put_contents($tempFile, $content);
                $phpWord = IOFactory::load($tempFile);
                unlink($tempFile);

                $text = '';
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        if (method_exists($element, 'getText')) {
                            $text .= $element->getText() . ' ';
                        }
                    }
                }
                return trim($text);
            } elseif (in_array($mimeType, ['application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])) {
                $tempFile = tempnam(sys_get_temp_dir(), 'excel');
                file_put_contents($tempFile, $content);
                $spreadsheet = SpreadsheetIOFactory::load($tempFile);
                unlink($tempFile);
                $worksheet = $spreadsheet->getActiveSheet();
                return implode(' ', array_map('implode', $worksheet->toArray()));
            } elseif (str_contains($mimeType, 'text/plain')) {
                return $content;
            } elseif (str_contains($mimeType, 'csv')) {
                $handle = fopen('php://memory', 'r+');
                fwrite($handle, $content);
                rewind($handle);

                $extractedContent = '';
                while (($row = fgetcsv($handle)) !== false) {
                    $extractedContent .= implode(' ', $row) . "\n";
                }
                fclose($handle);
                return trim($extractedContent);
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
