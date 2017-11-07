<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Themeshub</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
       
        <style>
            body{
                font-family: sans-serif;
            }
            table{
                font-family: sans-serif;
            }
            @media (max-width:767px) and (min-width:300px){
                table{
                    width: 100%;
                    margin: 0 auto;
                }
                .float-left_rsponsive{
                    float: left;
                }
                *, *::after, *::before {
                    box-sizing: inherit;
                }
                .p-0{
                    padding: 0 !important;
                }
                .text-center{
                    text-align: center;
                }
            }
        </style>
    </head>
    <body>
        <div  style="margin:0;padding:0;background-color: #f2f2f2;">
            <table  align="center" width="600" cellspacing="0" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td bgcolor="#f2f2f2" align="center">
                            <!--Header-->
                            <table width="600" cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td style="padding-top:40px;padding-bottom:40px" align="center">
                                            <a href="<?php echo base_url(); ?>">
                                                <img class="float-left_rsponsive" src="<?php echo base_url() . img_path . "/logo.png"; ?>" alt="themeshub" style="font-size:24px;color:#4b4b4b;font-weight:bold" width="300" border="0" height="75">
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--/Header-->
