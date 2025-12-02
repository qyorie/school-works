import Image from 'next/image'

export default function Portfolio() {
  const projects = [
    {
      title: 'WEATHER APP',
      image: '/project-1.png',
      description: 'A responsive weather web app using vanilla JavaScript, HTML, and CSS to display real-time forecasts with location-based search functionality via a weather API.',
      link: 'https://github.com/qyorie/school-works',
      bgClass: 'secondary-bg'
    },
    {
      title: 'LAUNDRY TRACKING',
      image: '/project-2.png',
      description: 'Web-based platform to track laundry pickup, washing, drying, delivery status, and customer orders — ideal for laundromats or delivery laundry services.',
      link: 'https://github.com/qyorie/school-works/tree/main/CC5',
      bgClass: 'primary-bg'
    },
    {
      title: 'INSIGHTBOARD',
      image: '/project-3.png',
      description: 'Monitor key metrics with custom charts, real-time updates, and report exports.',
      link: 'https://github.com/qyorie/school-works',
      bgClass: 'secondary-bg'
    },
    {
      title: 'DATA ANALYTIC (PYTHON)',
      image: '/project-4.png',
      description: 'Data Analytics is the process of collecting, organizing and studying data to find useful information understand what\'s happening and make better decisions.',
      link: 'https://github.com/qyorie/school-works/tree/main/CSP4/project-data-science',
      bgClass: 'primary-bg'
    },
    {
      title: 'GENETIC ALGORITHM',
      image: '/project-5.png',
      description: 'A genetic algorithm is a search and optimization method inspired by natural selection to find optimal solutions to complex problems.',
      link: 'https://github.com/qyorie/school-works/tree/main/CSP3',
      bgClass: 'secondary-bg'
    }
  ]

  return (
    <section className="portfolio py-6" id="portfolio">
      <div className="container">
        <h2 className="section-title">PORTFOLIO</h2>

        <div className="projects">
          {projects.map((project, index) => (
            <article key={index} className="card">
              <figure className="card-content">
                <Image 
                  src={project.image} 
                  alt={`${project.title} Screenshot`}
                  width={400}
                  height={200}
                />
                <figcaption className="card-details-wrapper">
                  <div className={`card-details ${project.bgClass}`}>
                    <h3 className="card-title">{project.title}</h3>
                    <p>{project.description}</p>
                    <a href={project.link} target="_blank" rel="noopener noreferrer">
                      <button className="btn btn-1">View</button>
                    </a>
                  </div>
                </figcaption>
              </figure>
            </article>
          ))}
        </div>
      </div>
    </section>
  )
}
