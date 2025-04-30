<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToText\Pdf;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Log;

class UploadDocument extends Component
{
    use WithFileUploads;

    public $file;
    public $allowedTypes = ['pdf', 'doc', 'docx', 'xlsx', 'jpg', 'png', 'txt'];
    public $maxSize = 10240; // 10MB in KB

    protected $rules = [
        'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xlsx,jpg,png,txt',
    ];

    public function updatedFile()
    {
        // Validate file as soon as it's selected
        $this->validateOnly('file');
        Log::info('File updated: ' . ($this->file ? $this->file->getClientOriginalName() : 'No file'));
    }

    public function uploadFile()
    {
        try {
            $this->validate();

            if (!$this->file) {
                throw new \Exception('No file selected.');
            }

            Log::info('Uploading file: ' . $this->file->getClientOriginalName());

            // Store file
            $path = $this->file->store('documents', 'public'); // Use 's3' for production
            $originalName = $this->file->getClientOriginalName();
            $mimeType = $this->file->getMimeType();
            $size = $this->file->getSize();

            // Extract text based on file type
            $content = $this->extractText($this->file->getRealPath(), $mimeType);

            // Save metadata and content to database
            Document::create([
                'user_id' => auth()->id(),
                'name' => $originalName,
                'path' => $path,
                'mime_type' => $mimeType,
                'size' => $size,
                'type' => $this->file->extension(),
                'content' => $content,
            ]);

            session()->flash('message', 'File uploaded successfully!');
            $this->reset('file'); // Clear file input after upload
        } catch (\Exception $e) {
            Log::error('File upload failed: ' . $e->getMessage());
            session()->flash('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }

    protected function extractText($filePath, $mimeType)
    {
        try {
            if (str_contains($mimeType, 'pdf')) {
                return Pdf::getText($filePath);
            } elseif (str_contains($mimeType, 'word')) {
                $phpWord = IOFactory::load($filePath);
                $content = '';
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        if (method_exists($element, 'getText')) {
                            $content .= $element->getText();
                        }
                    }
                }
                return $content;
            } elseif (str_contains($mimeType, 'text')) {
                return file_get_contents($filePath);
            }
        } catch (\Exception $e) {
            Log::error('Text extraction failed: ' . $e->getMessage());
        }
        return null;
    }

    public function render()
    {
        return view('livewire.upload-document');
    }
}
