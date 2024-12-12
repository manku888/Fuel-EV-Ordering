<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .flex-center {
            justify-content: center;
            align-items: center;
            height: 100vh;
            display: flex;
            background: url("/image/FuelStationImg.webp");
            background-size: cover;
            background-position: center;
        }

        .content {
            text-align: center;
            color: white;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent background to make text visible */
            border-radius: 10px;
        }

        a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin: 0 15px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="flex-center">
        <div class="">
            <h1 class="text-9xl" >Welcome to Our EvOil Application</h1>
            <div>
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Login</a> |
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            </div>
        </div>
    </div>
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/front.css">
</head>

<style>
    * {
    margin: 0;
    padding: 0;
    font-family:Arial, Helvetica, sans-serif;
    box-sizing: border-box;
}

/* HTML and Body */
html, body {
    height: 100%;
    width: 100%;
    background-color: #333;
    overflow-x: hidden;
}
img{
    height: 99%;
    width: 100%;
    /* filter: brightness(50%); */
}
.overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.4); /* Semi-transparent overlay for contrast */
        }
.buttons {
    display: flex;
    gap: 20px; /* Add this line for spacing between buttons */
}

.buttons a {
    text-decoration: none;
    color: white; /* Text color */
    font-size: 1.2rem;
    /* font-weight: bold; */
    padding: 10px 20px;
    background-color: #007bff; /* Button background color */
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.buttons a:hover {
    background-color: #984611; /* Hover background color */
}
h1{
    color: white;
}

span1{
    color: #000000;
}
span2{
    color: #007BFF;
}

</style>
<body>

<!-- <img src="/image/FuelStationImg.webp" > -->
<img src="\images\w1.jpg" >
<div class="overlay">
            <h1>Welcome to Our <span1>Ev</span1><span2>O</span2><span1>il</span1> Application</h1>
            <br/>
            <div class="buttons">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            </div>
        </div>

</body>
</html>
