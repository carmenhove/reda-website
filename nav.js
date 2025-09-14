function toggleMenu() {
    document.getElementById('navMenu').classList.toggle('active');
  }
  
  function toggleDropdown(event) {
    const isMobile = window.innerWidth <= 600;
    if (isMobile) {
      event.preventDefault();
      const parent = event.target.closest('.dropdown');
      parent.classList.toggle('open');
    }
  }
  