@extends('admin.layouts.app')

@section('content')
    <style>
        .enquiry-card {
            width: 100%;
            background: #fff;
            border-radius: 14px;
            padding: 24px 28px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.06);
        }

        .enquiry-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 22px;
        }

        .enquiry-title-wrap {
            flex: 1;
        }

        .enquiry-title {
            font-size: 26px;
            font-weight: 700;
            color: #1f2937;
            display: inline-block;
            border-bottom: 2px solid #9ca3af;
            padding-bottom: 4px;
            margin-bottom: 18px;
        }

        .top-mini-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            max-width: 650px;
        }

        .photo-box {
            width: 150px;
            height: 180px;
            border: 2px dashed #9ca3af;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #374151;
            font-weight: 700;
            font-size: 14px;
            background: #fafafa;
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-box span {
            letter-spacing: 1px;
        }

        .enquiry-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px 18px;
        }

        .full-col {
            grid-column: 1 / -1;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 7px;
            color: #111827;
        }

        .form-control {
            width: 100%;
            height: 46px;
            border: 1px solid #9ca3af;
            border-radius: 4px;
            padding: 0 12px;
            font-size: 15px;
            background: #fff;
            outline: none;
        }

        .form-control:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.10);
        }

        .file-control {
            height: auto;
            padding: 10px 12px;
        }

        .enquiry-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
        }

        .btn {
            display: inline-block;
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #64748b;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #475569;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 18px;
            border: 1px solid #fecaca;
        }

        .error-list {
            margin: 8px 0 0 18px;
        }

        .bottom-submit {
            margin-top: 18px;
        }

        @media (max-width: 991px) {
            .enquiry-header {
                flex-direction: column;
            }

            .top-mini-row {
                grid-template-columns: 1fr;
                max-width: 100%;
            }

            .photo-box {
                width: 130px;
                height: 160px;
            }

            .enquiry-grid {
                grid-template-columns: 1fr;
            }

            .full-col {
                grid-column: auto;
            }

            .enquiry-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
        }
    </style>

    <div class="enquiry-card">
        <div class="enquiry-actions">
            <h3 style="font-size: 24px; margin: 0; color: #111827;">Add Enquiry</h3>
            <a href="{{ route('enquiry.index') }}" class="btn btn-secondary">Back</a>
        </div>

        @if ($errors->any())
            <div class="alert-danger">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('enquiry.store') }}" method="POST" enctype="multipart/form-data">
         @csrf

    <div class="enquiry-header">
        <div class="enquiry-title-wrap">
            <div class="top-info-grid">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name') }}" placeholder="Enter name">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email') }}" placeholder="Enter email">
                </div>

                <div class="form-group full-width">
                    <label>Phone Number</label>
                    <input type="text" name="phone_number" class="form-control"
                        value="{{ old('phone_number') }}" placeholder="Enter phone number">
                </div>
            </div>
        </div>

        <div>
            <div class="photo-box" id="imagePreviewBox">
                <span>PHOTO</span>
            </div>
        </div>
    </div>

    <div class="enquiry-grid">
        <div class="form-group">
            <label>Course Name</label>
            <select name="course_name" class="form-control">
                    <option value="">Select Course</option>
                    <option value="DCA" {{ old('course_name') == 'DCA' ? 'selected' : '' }}>DCA</option>
                    <option value="ADCA" {{ old('course_name') == 'ADCA' ? 'selected' : '' }}>ADCA</option>
                    <option value="PGDCA" {{ old('course_name') == 'PGDCA' ? 'selected' : '' }}>PGDCA</option>
                    <option value="Tally" {{ old('course_name') == 'Tally' ? 'selected' : '' }}>Tally</option>
                    <option value="CCC" {{ old('course_name') == 'CCC' ? 'selected' : '' }}>CCC</option>
                    <option value="Basic Computer" {{ old('course_name') == 'Basic Computer' ? 'selected' : '' }}>Basic Computer</option>
         </select>
        </div>

       

        <div class="form-group">
            <label>Total Fee</label>
            <input type="number" step="0.01" name="total_fees" id="total_fees" class="form-control"
                value="{{ old('total_fees') }}" placeholder="Enter total fee">
        </div>

        <div class="form-group">
            <label>Deposite Fee</label>
            <input type="number" step="0.01" name="due_fees" id="due_fees" class="form-control"
                value="{{ old('due_fees') }}" placeholder="Enter deposite fee">
        </div>

        <div class="form-group">
            <label>Remaining Fee</label>
            <input type="number" step="0.01" name="revenue_fees" id="revenue_fees" class="form-control"
                value="{{ old('revenue_fees') }}" placeholder="Auto calculated" readonly>
        </div>

      

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" id="imageInput" class="form-control file-control" accept="image/*">
        </div>

        <div class="form-group">
            <label>Docs</label>
            <input type="file" name="docs[]" class="form-control file-control" multiple>
        </div>
    </div>

    <div class="bottom-submit" style="display:flex; gap:12px; flex-wrap:wrap;">
    <button type="submit" name="action" value="save" class="btn btn-primary">
        Save Enquiry
    </button>

    <!-- <button type="submit" name="action" value="save_download" class="btn btn-secondary">
        Save & Download I-Card
    </button> -->
</div>
</form>
    </div>

    <script>
        const totalFees = document.getElementById('total_fees');
        const dueFees = document.getElementById('due_fees');
        const revenueFees = document.getElementById('revenue_fees');
        const imageInput = document.getElementById('imageInput');
        const imagePreviewBox = document.getElementById('imagePreviewBox');

        function calculateRevenueFees() {
            let total = parseFloat(totalFees.value) || 0;
            let due = parseFloat(dueFees.value) || 0;
            let revenue = total - due;

            if (revenue < 0) {
                revenue = 0;
            }

            revenueFees.value = revenue.toFixed(2);
        }

        totalFees.addEventListener('input', calculateRevenueFees);
        dueFees.addEventListener('input', calculateRevenueFees);
        calculateRevenueFees();

        imageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (!file) {
                imagePreviewBox.innerHTML = '<span>POTO</span>';
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreviewBox.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        });
    </script>
@endsection