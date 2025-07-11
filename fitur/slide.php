<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="slider">
        <div class="slides">
    <img src="assets/slide1.jpg" class="slide" alt="Promo 1">
    <img src="assets/slide2.jpg" class="slide" alt="Promo 2">
    <img src="assets/slide3.jpg" class="slide" alt="Promo 3">
  </div>
</div>
    <style>
        .slider {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: auto;
            overflow: hidden;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            min-width: 100%;
            box-sizing: border-box;
        }
    </style>
    <script>
        let currentIndex = 0;

        function showSlide(index) {
            const slides = document.querySelector('.slides');
            const totalSlides = document.querySelectorAll('.slide').length;
            if (index >= totalSlides) {
                currentIndex = 0;
            } else if (index < 0) {
                currentIndex = totalSlides - 1;
            } else {
                currentIndex = index;
            }
            slides.style.transform = `translateX(-${currentIndex * 100}%)`;
        }

        setInterval(() => {
            showSlide(currentIndex + 1);
        }, 3000);
    </script>
</body>
</html>