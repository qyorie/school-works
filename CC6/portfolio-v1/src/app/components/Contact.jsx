'use client'

import { useState } from 'react'
import Image from 'next/image'

export default function Contact() {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    message: ''
  })

  const handleSubmit = (e) => {
    e.preventDefault()
    // Add your form submission logic here
    console.log('Form submitted:', formData)
    alert('Message sent! (This is a demo)')
  }

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value
    })
  }

  return (
    <section className="contact py-6" id="contact">
      <h2 className="section-title container">Let's work together!</h2>
      <div className="contact-container container fs-2">
        <div className="contact-message-wrapper">
          <div className="contact-message">
            <p>
              I'm always excited to collaborate on new projects or opportunities. 
              Feel free to reach out via email or connect with me on social media!
            </p>
            <div className="contact-info">
              <p>Email: troy@gmail.com</p>
              <p>GitHub: github.com/troy</p>
              <p>Contact: 09123456789</p>
            </div>
          </div>
        </div>
        <div className="contact-form-wrapper">
          <form onSubmit={handleSubmit} className="contact-form">
            <h3>Send me a message</h3>
            <input 
              type="text" 
              name="name" 
              placeholder="Name" 
              required 
              value={formData.name}
              onChange={handleChange}
            />
            <input 
              type="email" 
              name="email" 
              placeholder="Email" 
              required 
              value={formData.email}
              onChange={handleChange}
            />
            <textarea 
              name="message" 
              placeholder="Message" 
              required
              value={formData.message}
              onChange={handleChange}
            />
            <button type="submit" className="btn btn-1">Send Message</button>
          </form>
        </div>
      </div>
    </section>
  )
}
