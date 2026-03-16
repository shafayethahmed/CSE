@extends('layout.sidebar')

@section('title', $notice->title)

@push('styles')
<style>
/* ===== PAGE WRAPPER ===== */
.notice-wrapper {
    padding: 15px;
    font-family: "Times New Roman", serif;
    font-size: 14px;
}

/* ===== A4 PAPER ===== */
.notice-paper {
    width: 210mm;
    min-height: 297mm;
    background: #fff;
    margin: 0 auto;
    padding: 20mm 25mm;
    color: #000;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    box-sizing: border-box;
    position: relative;
}

/* ===== PRINT ===== */
@media print {
    body * { visibility: hidden; }
    .notice-paper, .notice-paper * { visibility: visible; }
    .notice-paper {
        position: absolute;
        left: 0;
        top: 0;
        width: 210mm;
        min-height: 297mm;
        box-shadow: none;
        padding: 20mm 25mm;
    }
}

/* ===== HEADER ===== */
.notice-header {
    display: flex;
    align-items: center;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
    margin-bottom: 15px;
}

.notice-header img {
    width: 90px;
    height: auto;
    margin-right: 12px;
}

.notice-header-text h3 {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
}

.notice-header-text h4 {
    margin: 2px 0;
    font-size: 15px;
    font-style: italic;
    text-align: center;
}

.notice-header-text p {
    margin: 2px 0;
    font-size: 12px;
    text-align: center;
}

/* ===== NOTICE INFO ===== */
.notice-info {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    margin-bottom: 20px;
}

/* ===== TITLE ===== */
.notice-title {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    text-decoration: underline;
    margin-bottom: 20px;
}

/* ===== BODY ===== */
.notice-body {
    font-size: 14px;
    line-height: 1.8;
    text-align: justify;
}

/* ===== SIGNATURE ===== */
.notice-signature {
    margin-top: 70px;
    width: 300px;
    float: left;
    text-align: left;
}

.notice-signature p {
    margin: 3px 0;
}

/* ===== FOOTER ===== */
.notice-footer {
    clear: both;
    margin-top: 80px;
    border-top: 2px solid #000;
    padding-top: 8px;
    font-size: 11px;
    text-align: center;
}

/* ===== SMALL SYSTEM NOTE ===== */
.notice-system-note {
    margin-top: 5px;
    font-size: 10px;
    text-align: center;
    font-style: italic;
}

/* ===== BUTTONS ===== */
.notice-actions {
    margin-bottom: 12px;
}
.notice-actions button {
    margin-right: 6px;
}
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.11.0/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const element = document.querySelector('.notice-paper');
    const opt = {
        margin:       10,
        filename:     '{{ str_replace(" ", "_", $notice->title) }}.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}
</script>
@endpush

@section('content')

<div class="notice-wrapper">

    {{-- PRINT / PDF BUTTONS --}}
    <div class="notice-actions">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Print Notice
        </button>
        <button onclick="downloadPDF()" class="btn btn-success">
            <i class="fas fa-download"></i> Download PDF
        </button>
    </div>

    <div class="notice-paper">

        {{-- HEADER --}}
        <div class="notice-header">
            <img src="{{ asset('images/RTM-Logo.jpg') }}">
            <div class="notice-header-text">
                <h3>RTM Al-Kabir Technical University (RTM-AKTU)</h3>
                <h4>Department Of Computer Science & Engineering</h4>
                <p>E-mail: info@rtm-aktu.edu.bd</p>
                <p>Web: www.rtm-aktu.edu.bd</p>
            </div>
        </div>

        {{-- NOTICE NUMBER + DATE --}}
        <div class="notice-info">
            <div>
                <strong>Notice No:</strong> RTM-AKTU/{{ $notice->notice_id }}
            </div>
            <div>
                <strong>Date:</strong> {{ \Carbon\Carbon::parse($notice->created_date)->format('d F Y') }}
            </div>
        </div>

        {{-- TITLE --}}
        <div class="notice-title">
            {{ $notice->title }}
        </div>

        {{-- BODY --}}
        <div class="notice-body">
            {!! nl2br(e($notice->body)) !!}
        </div>

        {{-- SIGNATURE --}}
        <div class="notice-signature">
            <p><strong>Published By</strong></p>
            <p>{{ $notice->published_by }}</p>
            <p>{{ $notice->designation }}</p>
            <p>RTM Al Kabir Technical University</p>
        </div>

        {{-- FOOTER --}}
        <div class="notice-footer">
            Sylhet: TB Gate, East Shahid Eidgah, Sylhet-3100, Bangladesh |
            Dhaka Liaison Office: 581, Shewrapara, Mirpur, Dhaka 1216
        </div>

        {{-- SYSTEM NOTE --}}
        <div class="notice-system-note">
            This notice was created by the RTM-AKTU CSE Management System.
        </div>

    </div>
</div>

@endsection