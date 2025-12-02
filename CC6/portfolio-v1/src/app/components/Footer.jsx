import Image from 'next/image'

export default function Footer() {
  return (
    <footer>
      <div className="footer-content container">
        <div className="contact-links">
          <li><a href="https://www.facebook.com/profile.php?id=100091084700258" target="_blank" rel="noopener noreferrer"><Image src="/fb.png" alt="Facebook" width={32} height={32} /></a></li>
          <li><a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><Image src="/in.png" alt="LinkedIn" width={32} height={32} /></a></li>
          <li><a href="https://x.com/" target="_blank" rel="noopener noreferrer"><Image src="/x.png" alt="X" width={32} height={32} /></a></li>
          <li><a href="https://github.com/qyorie" target="_blank" rel="noopener noreferrer"><Image src="/git-white.png" alt="GitHub" width={32} height={32} /></a></li>
        </div>
        <p>&copy; 2024 Troy Tristan Jacob. All rights reserved.</p>
      </div>
    </footer>
  )
}