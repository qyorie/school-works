import Image from 'next/image'

export default function About() {
  return (
    <section className="about py-6" id="about">
      <div className="about-content container">
        <Image 
          src="/about-img.png" 
          alt="About Image"
          width={400}
          height={400}
        />
        <div className="about-info">
          <h2 className="section-title">ABOUT ME</h2>
          <p>
            I'm a detail-oriented and solutions-driven software engineer with a passion for building reliable systems and clean user experiences. 
            My work spans both web and mobile platforms, with a focus on writing maintainable code and delivering real-world impact.
          </p>
          <p>
            I enjoy solving complex problems through simple, scalable architecture—whether that means building RESTful APIs, crafting seamless front-end interfaces, 
            or optimizing database performance.
          </p>
          <p>
            I thrive in collaborative environments, love learning new technologies, and take pride in delivering work that not only functions well but feels intuitive to use.
          </p>
        </div>
      </div>
    </section>
  )
}