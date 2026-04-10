@extends('auth-faculty.layout.sidebar')
@section('title', 'Faculty Dashboard')

@push('styles')
<style>
    /* ===== Small Summary Cards ===== */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .summary-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        transition: all 0.3s ease;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .summary-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        border-color: #cbd5e1;
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #fff;
        flex-shrink: 0;
    }

    .bg-blue { background: linear-gradient(135deg, #2563eb, #1d4ed8); }
    .bg-green { background: linear-gradient(135deg, #16a34a, #15803d); }
    .bg-orange { background: linear-gradient(135deg, #ea580c, #c2410c); }
    .bg-purple { background: linear-gradient(135deg, #7c3aed, #6d28d9); }
    .bg-red { background: linear-gradient(135deg, #dc2626, #b91c1c); }
    .bg-teal { background: linear-gradient(135deg, #0d9488, #0f766e); }

    .summary-text h4 {
        font-size: 14px;
        font-weight: 500;
        margin: 0 0 5px 0;
        color: #6b7280;
        letter-spacing: 0.3px;
    }

    .summary-text p {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        color: #1f2937;
    }

    /* ===== Development Notice Card ===== */
    .development-notice {
        background: linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%);
        border: 1px solid #fde68a;
        border-radius: 16px;
        padding: 40px 30px;
        text-align: center;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .development-notice h5 {
        font-size: 22px;
        font-weight: 600;
        color: #92400e;
        margin-bottom: 15px;
    }

    .development-notice p {
        font-size: 16px;
        color: #78350f;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .development-notice small {
        font-size: 13px;
        color: #b45309;
        background: #fff3e0;
        padding: 8px 16px;
        border-radius: 20px;
        display: inline-block;
    }

    .development-icon {
        font-size: 48px;
        color: #f59e0b;
        margin-bottom: 20px;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .summary-grid {
            gap: 12px;
        }
        
        .summary-card {
            padding: 15px;
        }
        
        .summary-icon {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
        
        .summary-text p {
            font-size: 20px;
        }
        
        .development-notice {
            padding: 30px 20px;
        }
        
        .development-notice h5 {
            font-size: 18px;
        }
        
        .development-notice p {
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
<div>
    <!-- Summary Cards Section -->
    <div class="summary-grid">
        <div class="summary-card">
            <div class="summary-icon bg-blue">
                <i class="fas fa-credit-card"></i>
            </div>
            <div class="summary-text">
                <h4>Credit Limit</h4>
                <p>{{ $TotalCreditLimit }}</p>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon bg-green">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="summary-text">
                <h4>Credit Taken</h4>
                <p>{{ $TotalCreditTaken }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-purple">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div class="summary-text">
                <h4>Courses Assigned</h4>
                <p>{{ $TotalCoursesUnderMe }}</p>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon bg-teal">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="summary-text">
                <h4>Total Students</h4>
                <p>{{ $TotalStudentUnderMe }}</p>
            </div>
        </div>
    </div>

    <!-- Development Notice Card -->
    <div class="development-notice">
        <div class="development-icon">
            <i class="fas fa-tools"></i>
        </div>
        <h5>🚧 Faculty Dashboard</h5>
        <p class="text-muted">
            The complete dashboard view will be displayed once all system components are fully developed and activated.
        </p>
        <small>
            ⚠️ This is a development notice. Full features will be available after system completion.
        </small>
    </div>
</div>
@endsection