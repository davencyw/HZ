    </main>
    <footer class="site-footer">
        <div class="footer-content">
            <p class="footer-names">David & Sarah</p>
            <p class="footer-date">15. August 2026</p>
        </div>
    </footer>
    <script>
        // Mobile navigation toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navLinks = document.querySelector('.nav-links');
        
        navToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            navToggle.classList.toggle('active');
        });
    </script>
</body>
</html>
