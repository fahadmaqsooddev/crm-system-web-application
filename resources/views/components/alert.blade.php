@props(['type' => 'success', 'message'])

@if ($message)
    <div 
        id="alert-message"
        {{ $attributes->merge(['class' => "alert alert-{$type}"]) }} 
        role="alert"
    >
        {{ $message }}
    </div>

    <script>
        setTimeout(() => {
            const alert = document.getElementById('alert-message');
            if(alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        }, 2000); 
    </script>
@endif
