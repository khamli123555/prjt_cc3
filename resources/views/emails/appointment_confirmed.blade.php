<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; line-height: 1.6; color: #1e293b; background-color: #f8fafc; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; }
        .header { background-color: #4f46e5; padding: 40px 20px; text-align: center; color: #ffffff; }
        .content { padding: 40px; }
        .title { font-size: 24px; font-weight: 700; margin-bottom: 24px; color: #0f172a; }
        .details { background-color: #f1f5f9; border-radius: 12px; padding: 24px; margin-bottom: 32px; }
        .detail-row { display: flex; margin-bottom: 12px; }
        .detail-label { font-weight: 600; width: 120px; color: #64748b; }
        .detail-value { font-weight: 500; color: #0f172a; }
        .footer { padding: 24px; background-color: #f8fafc; border-top: 1px solid #e2e8f0; text-align: center; font-size: 14px; color: #64748b; }
        .btn { display: inline-block; padding: 12px 24px; background-color: #ef4444; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 style="margin:0; font-size: 28px;">MedAppoint</h1>
        </div>
        <div class="content">
            <h2 class="title">{{ __('app.flash.appointment_created') }}</h2>
            <p>{{ __('app.email.dear') }} {{ $appointment->patient->name }},</p>
            <p>{{ __('app.email.appointment_confirmed') }}</p>
            
            <div class="details">
                <div class="detail-row">
                    <span class="detail-label">{{ __('app.appointment.doctor') }}:</span>
                    <span class="detail-value">{{ $appointment->doctor->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">{{ __('app.appointment.service') }}:</span>
                    <span class="detail-value">{{ $appointment->service->name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">{{ __('app.appointment.date_time') }}:</span>
                    <span class="detail-value">{{ $appointment->date->format('M d, Y \a\t h:i A') }}</span>
                </div>
            </div>

            <p>{{ __('app.email.change_cancel') }}</p>
            <a href="{{ route('appointments.index') }}" class="btn">{{ __('app.buttons.cancel') }}</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} MedAppoint. {{ __('app.email.all_rights_reserved') }}
        </div>
    </div>
</body>
</html>
