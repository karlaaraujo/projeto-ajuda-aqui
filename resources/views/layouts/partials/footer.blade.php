@section('styles')
<link rel="stylesheet" href="{{ asset('css/layouts/footer.css')}}">
@endsection

<div class="footer-container">
    <div class="footer-content">
        <!-- Logo -->
        <div class="footer-logo">
            <a href="{{ route('home') }}">
                <img class="logo-footer" src="{{ asset('img/2.png') }}" alt="logo Ajuda Aqui">
            </a>
        </div>

        <!-- Links -->
        <div class="footer-links">
            <a href="#" class="footer-link">Suporte</a>
            <a href="#" class="footer-link">Sobre Nós</a>
            <a href="#" class="footer-link">Como Ajudar</a>
        </div>
    </div>

    <hr class="footer-divider" />

    <!-- Bottom Section -->
    <div class="footer-bottom">
        <span class="footer-copyright">
            © Ajuda Aqui 2025. Juntos fazemos a diferença!
        </span>
        <div class="footer-socials">
            <span class="social-icon">⚪</span>
            <span class="social-icon">⚪</span>
            <span class="social-icon">⚪</span>
            <span class="social-icon">⚪</span>
        </div>
    </div>
</div>
