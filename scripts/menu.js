const menuSide = document.getElementById('menu-side');
const contentMain = document.getElementById('content-main');

function hideMenu() {
    menuSide.style.transform = 'translateX(0%)';
    contentMain.style.width = '100vw';
}

function showMenu() {
    menuSide.style.transform = 'translateX(100%)';
    contentMain.style.width = '80vw';
}
