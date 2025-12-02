'use client'

import { useState, useEffect } from 'react'
import Link from 'next/link'

export default function Navbar() {
  const [isScrolled, setIsScrolled] = useState(false)
  const [isMenuOpen, setIsMenuOpen] = useState(false)

  useEffect(() => {
    const handleScroll = () => {
      setIsScrolled(window.scrollY > 50)
    }

    window.addEventListener('scroll', handleScroll)
    return () => window.removeEventListener('scroll', handleScroll)
  }, [])

  const scrollToSection = (e, id) => {
    e.preventDefault()
    
    const element = document.getElementById(id)
    if (element) {
      const elementPosition = element.getBoundingClientRect().top;
      const offsetPosition = elementPosition + window.pageYOffset - 80;
      window.scrollTo({
        top: offsetPosition,
        behavior: 'smooth'
      })
      setIsMenuOpen(false)
    }
  }


  return (
    <nav className={`navbar ${isScrolled ? 'scrolled' : ''}`} id="navbar">
      <div className="nav-container">
        <div className="logo">
          <a href="#home" onClick={(e) => scrollToSection(e, 'home')}>[ TJ ]</a>
        </div>

        <div className={`nav-menu ${isMenuOpen ? 'active' : ''}`} id="nav-menu">
          <ul className="nav-links">
            <li><strong><a href="#skills" onClick={(e) => scrollToSection(e, 'skills')}>SKILLS</a></strong></li>
            <li><strong><a href="#portfolio" onClick={(e) => scrollToSection(e, 'portfolio')}>PORTFOLIO</a></strong></li>
            <li><strong><a href="#about" onClick={(e) => scrollToSection(e, 'about')}>ABOUT</a></strong></li>
            <li><strong><a href="#contact" onClick={(e) => scrollToSection(e, 'contact')}>CONTACT</a></strong></li>
          </ul>
        </div>
        <a 
          href="https://docs.google.com/document/d/1WicV-uUysNS7kf1HtFe2wTV4eyE3D9te7sxp7rxVpck/edit?usp=drive_link"
          target="_blank"
          rel="noopener noreferrer"
          style={{textDecoration: "none"}}
        >
          <button className="btn btn-2">Resume</button>
        </a>

        <div className="burger" id="burger" onClick={() => setIsMenuOpen(!isMenuOpen)}>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </nav>
  )
}