<?php
//se existir
if (isset($_COOKIE['corCookie'])){

    $cor = $_COOKIE['corCookie'];
        
    echo("<style>
            #mainNavLog {
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                background-color: ".$cor.";
                backdrop-filter: blur(10.5px);
                -webkit-backdrop-filter: blur(10.5px);
                transition: background-color 0.2s ease;
              }
              #mainNavLog .navbar-brand {
                font-family: 'Merriweather Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
                font-weight: 700;
                color: #ffffff;
              }
              #mainNavLog .navbar-nav .nav-item .nav-link {
                color: #ffffff;
                font-family: 'Merriweather Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
                font-weight: 700;
                font-size: 0.9rem;
                padding: 0.75rem 0;
              }
              #mainNavLog .navbar-nav .nav-item .nav-link:hover, #mainNavLog .navbar-nav .nav-item .nav-link:active {
                color: #ffffff;
              }
              #mainNavLog .navbar-nav .nav-item .nav-link.active {
                color: #ffffff !important;
              }
              
              @media (min-width: 992px) {
                #mainNavLog {
                  box-shadow:#212529;
                  background-color: ".$cor.";
                }
                #mainNavLog .navbar-brand {
                  font-family: 'Merriweather Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
                  font-weight: 700;
                  color: #ffffff;
                 /* color: rgba(0, 0, 0, 0.7);
                  color: rgba(255, 255, 255, 0.7);*/
                }
               
                #mainNavLog .navbar-nav .nav-item .nav-link {
                  /*color: rgba(255, 255, 255, 0.7);*/
                  color: rgba(255, 255, 255, 0.7);
                  padding: 0 1rem;
                }
                #mainNavLog .navbar-nav .nav-item .nav-link:hover {
                  color: #ffffff;
                }
                #mainNavLog .navbar-nav .nav-item:last-child .nav-link {
                  padding-right: 0;
                }
                #mainNavLog.navbar-shrink {
                  box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
                  background-color: rgba(255, 255, 255, 0.85);
                }
                #mainNavLog.navbar-shrink .navbar-brand {
                  color: #ffffff;
                }
                #mainNavLog.navbar-shrink .navbar-brand:hover {
                  color: #ffffff;
                }
                #mainNavLog.navbar-shrink .navbar-nav .nav-item .nav-link {
                  color: #ffffff;
                }
                #mainNavLog.navbar-shrink .navbar-nav .nav-item .nav-link:hover {
                  color: #ffffff;
              
                }
              }
     </style>
     <html lang='pt-br' data-bs-theme='dark'>
     ");

}else {

    echo("<style>
        /* Menu logado*/
        #mainNavLog {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        background-color: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10.5px);
        -webkit-backdrop-filter: blur(10.5px);
        transition: background-color 0.2s ease;
        }
        #mainNavLog .navbar-brand {
        font-family: 'Merriweather Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 700;
        color: #212529;
        }
        #mainNavLog .navbar-nav .nav-item .nav-link {
        color: #6c757d;
        font-family: 'Merriweather Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        font-weight: 700;
        font-size: 0.9rem;
        padding: 0.75rem 0;
        }
        #mainNavLog .navbar-nav .nav-item .nav-link:hover, #mainNavLog .navbar-nav .nav-item .nav-link:active {
        color: #0d6efd;
        }
        #mainNavLog .navbar-nav .nav-item .nav-link.active {
        color: #0d6efd !important;
        }
        
        @media (min-width: 992px) {
        #mainNavLog {
            box-shadow:#212529;
            background-color: rgba(255, 255, 255, 0.85);
        }
        #mainNavLog .navbar-brand {
            font-family: 'Merriweather Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
            font-weight: 700;
            color: #212529;
            /* color: rgba(0, 0, 0, 0.7);
            color: rgba(255, 255, 255, 0.7);*/
        }
        
        #mainNavLog .navbar-nav .nav-item .nav-link {
            /*color: rgba(255, 255, 255, 0.7);*/
            color: rgba(0, 0, 0, 0.7);
            padding: 0 1rem;
        }
        #mainNavLog .navbar-nav .nav-item .nav-link:hover {
            color: #0d6efd;
        }
        #mainNavLog .navbar-nav .nav-item:last-child .nav-link {
            padding-right: 0;
        }
        #mainNavLog.navbar-shrink {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            background-color: rgba(255, 255, 255, 0.85);
        }
        #mainNavLog.navbar-shrink .navbar-brand {
            color: #212529;
        }
        #mainNavLog.navbar-shrink .navbar-brand:hover {
            color: #0d6efd;
        }
        #mainNavLog.navbar-shrink .navbar-nav .nav-item .nav-link {
            color: #212529;
        }
        #mainNavLog.navbar-shrink .navbar-nav .nav-item .nav-link:hover {
            color: #0d6efd;
        
        }
        }
    </style>");
}

?> 