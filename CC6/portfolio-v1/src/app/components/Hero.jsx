import Image from 'next/image'

export default function Hero() {
  return (
    <section className="hero" id="home">
      <div className="container hero-container">
        <div className="hero-info">
          <p className="hero-greeting"> Kumusta! 👋 </p>
          <p className="hero-name">I'm Troy Tristan Jacob</p>
          <h1 className="hero-title">SOFTWARE ENGINEER</h1>
          <p className="hero-description">
            Building scalable, efficient, and elegant solutions that power modern web and mobile applications. Ready to bring your ideas to life.
          </p>
          <button className="btn btn-1">Partner with me</button>
        </div>
        <div className="hero-image">
          <Image src="/me.png" alt="Hero Image" width={400} height={350} />
          <div className="contact-links">
            <li><a href="https://www.facebook.com/profile.php?id=100091084700258" target="_blank" rel="noopener noreferrer"><Image src="/fb.png" alt="Facebook" width={32} height={32} /></a></li>
            <li><a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><Image src="/in.png" alt="LinkedIn" width={32} height={32} /></a></li>
            <li><a href="https://x.com/" target="_blank" rel="noopener noreferrer"><Image src="/x.png" alt="X" width={32} height={32} /></a></li>
            <li><a href="https://github.com/qyorie" target="_blank" rel="noopener noreferrer"><Image src="/git-white.png" alt="GitHub" width={32} height={32} /></a></li>
          </div>
        </div>
      </div>
    </section>
  )
}