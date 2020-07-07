<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Global Shiksha - Demo For Industry</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

<link rel="stylesheet"
    href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #EEEEEE;
                color: #000000;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                /*align-items: center;
                display: flex;
                justify-content: center*/;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
            	width: 90%;
            	margin:0 auto;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .header {
            	    border-bottom: 1px solid #fbfbfb;
				    -webkit-box-shadow: 1px 1px #e3e3e3;
				    -moz-box-shadow: 1px 1px #e3e3e3;
				    box-shadow: 1px 1px #e3e3e3;
				    margin-bottom: 0;
				    border-radius: 0;
				    background-color: #fbfbfb;
				    border: none;
            }
            .header h1 {
            	margin: 0;
            }
            .header h1 .title {
            	padding: 15px;
            }
            .card {
			  /* Add shadows to create the "card" effect */
			  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
			  transition: 0.3s;
			  padding: 15px;
			  background: #FFF;
			  margin-top: 20px;
			}

			/* On mouse-over, add a deeper shadow */
			.card:hover {
			  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
			}
			.card table {
				width: 100%;
			}
			.page-title h2 {
				padding:0;
				margin: 0;
			}
			.table>thead>tr>th {
				text-align: left;
			}
        </style>
    </head>
    <body>
    	<div class="flex header">
    		<h1>
    			<span class="title">Global Shiksha</span>
    		</h1>
    	</div>
        <div class="flex-center position-ref full-height">
            <div class="content">