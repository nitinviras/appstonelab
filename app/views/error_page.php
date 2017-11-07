<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Themeshub</title>
        <style>

            body{
                margin: 0;
            }
            #bg_image{
                background-color: #00D7B3;
            }
            h1 {
                font-size: 236px;
                text-align: center;
                color: #fff;
                margin-bottom: 2rem;
                margin-top: 5rem;
            }
            button {
                padding: 15px 20px;
                background: #00D7B3;
                border: 2px solid #FAFEFF;
                border-radius: 5px;
                font-size: 15px;
                font-weight: 600;
                color: #fff;
                margin-bottom: 2rem;
            }
            .center {
                text-align: center;
            }
            .oops_text{
                font-size: 30px;
                color: #fff;
                font-weight: 600;
                margin-bottom: 4rem;
            }
            @media (max-width:767px){
                h1 {
                    font-size: 140px;
                }
            }
        </style>
    </head>
    <body id="bg_image">
        <div class="container-fluid">
            <div class="wrapper_error-page">
                <div class="center">
                    <h1>404</h1>
                    <p class="oops_text">Oops! The Page you requested was not found!</p>
                    <button>Back to Home Page </button>
                </div>
            </div>
        </div>
    </body>
</html>