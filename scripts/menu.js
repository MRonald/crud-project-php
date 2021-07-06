function hideMenu() {
    const menuSide = document.getElementById('menu-side');
    menuSide.style.transform = 'translateX(100%)';
}

function showMenu() {
    const menuSide = document.getElementById('menu-side');
    menuSide.style.transform = 'translateX(0%)';
}