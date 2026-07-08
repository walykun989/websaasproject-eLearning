<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'certificate_number',
        'issued_at',
        'file_path',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function generateCertificateNumber(): string
    {
        return 'CERT-WIB-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
    }

    public function generatePDF(): string
    {
        $pdf = \PDF::loadView('certificates.template', ['certificate' => $this])
            ->setPaper('a4', 'landscape')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true)
            ->setOption('dpi', 96);

        $filename = $this->certificate_number . '.pdf';
        $path = 'certificates/' . $filename;

        \Storage::put($path, $pdf->output());

        return $path;
    }
}
