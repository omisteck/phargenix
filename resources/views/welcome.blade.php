<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}} - CRM Application</title>
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,700|IBM+Plex+Sans:600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
    <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
								<img class="header-logo-image asset-light" src="dist/images/logo-light.svg" alt="Logo">
								<img class="header-logo-image asset-dark" src="dist/images/logo-dark.svg" alt="Logo">
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0">Welcome to {{env('APP_NAME')}} CRM Application</h1>
	                        <p class="hero-paragraph">Get an up-to-the-minute view of your entire sales on a clean, visual dashboard. With detailed reports on sales activity, productivity, and individual performance.
	                        <div class="hero-cta">
                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <a class="button button-primary" href="{{ url('/home') }}">Go to Dashboard </a>
                                    @else
                                        <a class="button button-primary" href="{{ route('login') }}">Login </a>
                                    @endauth
                                </div>
                            @endif
								
                                <a class="button button-success" href="#">Power by @omisteck- </a>
							</div>
						</div>
						<div class="hero-media">
							<div class="header-illustration">
								<img class="header-illustration-image asset-light" src="dist/images/header-illustration-light.svg" alt="Header illustration">
								<img class="header-illustration-image asset-dark" src="dist/images/header-illustration-dark.svg" alt="Header illustration">
							</div>
							<div class="hero-media-illustration">
								<img class="hero-media-illustration-image asset-light" src="dist/images/hero-media-illustration-light.svg" alt="Hero media illustration">
								<img class="hero-media-illustration-image asset-dark" src="dist/images/hero-media-illustration-dark.svg" alt="Hero media illustration">
							</div>
							<div class="hero-media-container">
								<img class="hero-media-image asset-light" src="dist/images/hero-media-light.png" style="width: 100%;" alt="Hero media">
								<img class="hero-media-image asset-dark" src="dist/images/hero-media-dark.svg" style="width: 100%;"alt="Hero media">
							</div>
						</div>
                    </div>
                </div>
            </section>



            <section class="features section">
                <div class="container">
					<div class="features-inner section-inner has-bottom-divider">
						<div class="features-header text-center">
							<div class="container-sm">
								<h2 class="section-title mt-0">The Product</h2>
	                            <p class="section-paragraph">Lorem ipsum is common placeholder text used to demonstrate the graphic elements of a document or visual presentation.</p>
								<div class="features-image">
									<img class="features-illustration asset-dark" src="dist/images/features-illustration-dark.svg" alt="Feature illustration">
									<img class="features-box asset-dark" src="dist/images/features-box-dark.svg" alt="Feature box">
									<img class="features-illustration asset-dark" src="dist/images/features-illustration-top-dark.svg" alt="Feature illustration top">
									<img class="features-illustration asset-light" src="dist/images/features-illustration-light.svg" alt="Feature illustration">
									<img class="features-box asset-light" src="dist/images/features-box-light.svg" alt="Feature box">
									<img class="features-illustration asset-light" src="dist/images/features-illustration-top-light.svg" alt="Feature illustration top">
								</div>
							</div>
                        </div>
                        <div class="features-wrap">
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="dist/images/feature-01-light.svg" alt="Feature 01">
										<img class="asset-dark" src="dist/images/feature-01-dark.svg" alt="Feature 01">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Discover</h3>
                                    	<p class="text-sm mb-0">Lorem ipsum dolor sit amet, consecte adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua dui.</p>
									</div>
								</div>
                            </div>
							<div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="dist/images/feature-02-light.svg" alt="Feature 02">
										<img class="asset-dark" src="dist/images/feature-02-dark.svg" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Discover</h3>
                                    	<p class="text-sm mb-0">Lorem ipsum dolor sit amet, consecte adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua dui.</p>
									</div>
								</div>
                            </div>
							<div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="dist/images/feature-03-light.svg" alt="Feature 03">
										<img class="asset-dark" src="dist/images/feature-03-dark.svg" alt="Feature 03">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Discover</h3>
                                    	<p class="text-sm mb-0">Lorem ipsum dolor sit amet, consecte adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua dui.</p>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            

			<section class="cta section">
                <div class="container-sm">
                    <div class="cta-inner section-inner">
                        <div class="cta-header text-center">
                            <h2 class="section-title mt-0">Get in Touch</h2>
                            <p class="section-paragraph">Feel free to contact us about the application or book a demo review of the application.</p>
							<div class="cta-cta">
								<a class="button button-primary" href="tel:09064629981">Call Us</a>
							</div>
					    </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="site-footer has-top-divider">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
                        <a href="#">
							<img class="asset-light" src="dist/images/logo-light.svg" alt="Logo">
							<img class="asset-dark" src="dist/images/logo-dark.svg" alt="Logo">
                        </a>
                    </div>
                   
                    <ul class="footer-social-links list-reset">
                        <li>
                            <a href="https://twitter.com/omisteck">
                                <span class="screen-reader-text">Twitter</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:talk2omis@gmail.com">
                                <span class="screen-reader-text">Gmail</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.9 7v2.4H12c-.2 1-1.2 3-4 3-2.4 0-4.3-2-4.3-4.4 0-2.4 2-4.4 4.3-4.4 1.4 0 2.3.6 2.8 1.1l1.9-1.8C11.5 1.7 9.9 1 8 1 4.1 1 1 4.1 1 8s3.1 7 7 7c4 0 6.7-2.8 6.7-6.8 0-.5 0-.8-.1-1.2H7.9z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <div class="footer-copyright">&copy; {{ now()->year }} Omisteck, all rights reserved</div>
                </div>
            </div>
        </footer>
    </div>

    <script src="{{ asset('dist/js/main.min.js') }}"></script>
</body>
</html>
