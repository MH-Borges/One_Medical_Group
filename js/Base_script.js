document.addEventListener( 'DOMContentLoaded', function() {
    document.getElementById("data_footer").textContent = new Date().getFullYear();
});

//MENU LATERAL
function sideMenu() {
    const sideMenu = document.getElementById('sideMenu');
    
    if (sideMenu.classList.contains('hide')) {
        sideMenu.classList.remove('hide');
        sideMenu.style.transition = 'right .25s';
        sideMenu.style.right = '0';

        const back = document.createElement("div");
        back.setAttribute('id', 'background');
        document.getElementsByTagName('header')[0].appendChild(back);

        back.onclick = function() { 
            sideMenu.style.transition = 'right .25s';
            sideMenu.style.right = '-25vw';
            document.getElementById('background').remove();
            setTimeout(() => { sideMenu.classList.add('hide'); }, 500);
        };
        
    } else {
        sideMenu.style.transition = 'right .25s';
        sideMenu.style.right = '-25vw';
        document.getElementById('background').remove();
        setTimeout(() => { sideMenu.classList.add('hide'); }, 500);
    }
}

//Scroll Menu
document.querySelectorAll('.links').forEach(item => { item.addEventListener('click', scrollToIdOnClick); });
function scrollToIdOnClick(event) {
    const targetElement = document.querySelector(event.currentTarget.getAttribute('href'));
    if (targetElement) {
        if(event.currentTarget.getAttribute('href') == '#home'){
            var targetOffset = targetElement.offsetTop;
        }else{
            var targetOffset = targetElement.offsetTop - 150;
        }
        smoothScrollTo(0, targetOffset);
    }
}
function smoothScrollTo(endX, endY, duration = 200) {
    const startX = window.scrollX || window.pageXOffset;
    const startY = window.scrollY || window.pageYOffset;
    const distanceX = endX - startX;
    const distanceY = endY - startY;
    const startTime = performance.now();
    const easeInOutQuart = (time, from, distance, duration) => {
        if ((time /= duration / 2) < 1) return distance / 2 * time * time * time * time + from;
        return -distance / 2 * ((time -= 2) * time * time * time - 2) + from;
    };
    function scroll() {
        const currentTime = performance.now();
        const elapsedTime = currentTime - startTime;
        if (elapsedTime >= duration) {
            window.scroll(endX, endY);
        } else {
            const newX = easeInOutQuart(elapsedTime, startX, distanceX, duration);
            const newY = easeInOutQuart(elapsedTime, startY, distanceY, duration);
            window.scroll(newX, newY);
            requestAnimationFrame(scroll);
        }
    }
    scroll();
}

//Whats Icon
window.addEventListener('scroll', function() {
    //whats icon
    if(window.pageYOffset > 200){ document.querySelector(".whats_link").classList.remove('hide'); }
    else{ document.querySelector(".whats_link").classList.add('hide'); }
});