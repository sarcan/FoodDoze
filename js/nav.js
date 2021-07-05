document.querySelector('.burger-nav .icon i').addEventListener('click', function(e) {
    console.log(e);
    this.classList.toggle('fa-bars');
    this.classList.toggle('fa-times');
    document.querySelector('.burger-nav-links ul').classList.toggle('active');
});