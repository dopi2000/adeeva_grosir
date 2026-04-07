 // Toggle sidebar untuk mobile
 const value = document.getElementById('toggleSidebarMobile');
 console.log(value);
        document.getElementById('toggleSidebarMobile').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        });
        
        // Tutup sidebar saat klik di luar sidebar pada mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebarMobile');
            const isMobile = window.innerWidth < 768;
            
            if (isMobile && !sidebar.contains(event.target) && !toggleBtn.contains(event.target) && !sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.add('-translate-x-full');
            }
        });