<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ Vite::asset('resources/assets/images/favicons/favicon-48x48.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/assets/images/favicons/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Vite::asset('resources/assets/images/favicons/favicon-192x192.png') }}">

        <title>@yield('title')</title>

        <!-- Styles -->
        <style id="" media="all">
            /* cyrillic-ext */
            @font-face {
	            font-display: swap;
	            font-family: 'Saira';
	            font-weight: 1 999;
	            src: url("{{ Vite::asset('resources/assets/fonts/saira-variable.ttf') }}") format("truetype-variations");
	            font-optical-sizing: auto;
            }
            @font-face {
                font-display: swap;
                font-family: "DM Sans";
                font-weight: 1 999;
                src: url("{{ Vite::asset('resources/assets/fonts/dm-sans-variable.ttf') }}") format("truetype-variations");
                font-optical-sizing: auto;
            }

            :root {
                --saira: 'Saira', sans-serif;
                --dm-sans: 'DM Sans', sans-serif;

                --base-color: #F9F9F9;
                --text-color: #111528;
                --secondary-text : #F7F9F7;
                --primary-color: #3a435d;
                --accent-color: #0059CF;

                --transition-default:  all .3s ease;
            }


            * {
	            margin: 0;
	            padding: 0;
	            box-sizing: border-box;
                font-family: var(--dm-sans);
                color: var(--text-color);
            }
            #error-message-container {
                width: 100vw;
                height: 100vh;
                background: var(--base-color);
                padding: 24px;
            }
            #error-message-container .error-message-content {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                height: 100%;
            }
            #error-message-container .error-message-title {
                font-family: var(--saira);
                font-size: 200px;
                font-weight: 500;
                display: flex;
                height: 200px;
                align-items: center;
            }
            #error-message-container .error-message-subtitle {
                max-width: 500px;
                font-size: 18px;
                font-weight: 600;
                text-transform: uppercase;
                text-align: center;
            }

            .spacing {
                display: flex;
                flex-direction: column;
                gap: 2rem;
                align-items: center;
                justify-content: center;
            }

            .btn {
                font-size: 18px;
                padding: 7px 37px;
                border: 1px solid currentColor;
                border-radius: 50px;
                background: transparent;
                color: currentColor;
                cursor: pointer;
                text-align: center;
                text-decoration: none;
                width: fit-content;
            }

            .btn-secondary {
	            border-color: var(--primary-color);
	            color: var(--text-color);
            }
            .btn-secondary:hover {
	            background: var(--primary-color);
	            color: var(--secondary-text);
	            transition: var(--transition-default);
            }

            @media screen and (max-width: 768px) {
                #error-message-container .error-message-title {
                    font-size: 150px;
                    height: 150px;
                }
            }
          </style>
    </head>
    <body>
        <div id="error-message-container">
            <div class="error-message-content">
                <h3 class="error-message-subtitle" tabindex="0">@yield('title')</h3>
                <h1 class="error-message-title" tabindex="0">@yield('code')</h1>
                <div class="spacing">
                    <h3 class="error-message-subtitle" tabindex="0">@yield('message')</h3>
                    <a class="btn btn-secondary" type="button" href="/dashboard" title="Ir para página home" tabindex="0">Home</a>
                </div>
            </div>
          </div>
    </body>
</html>
