export default function Skills() {
  const skillsData = {
    Languages: ['JavaScript', 'Python', 'C++', 'TypeScript', 'Java', 'SQL'],
    Frontend: ['React', 'Next.js', 'HTML5', 'CSS3', 'Tailwind CSS', 'Bootstrap', 'Vue.js', 'jQuery'],
    Backend: ['Node.js', 'Express', 'MongoDB', 'PostgreSQL', 'MySQL', 'REST APIs', 'Firebase']
  }

  return (
    <section className="skills py-6" id="skills">
      <div className="container skills-container">
        <h2 className="section-title">SKILLS</h2>
        
        <div className="skills-grid">
          {Object.entries(skillsData).map(([category, skills]) => (
            <div key={category} className="skill-category">
              <h3>{category}</h3>
              <div className="skill-items">
                {skills.map((skill) => (
                  <span key={skill} className="skill-item">{skill}</span>
                ))}
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}