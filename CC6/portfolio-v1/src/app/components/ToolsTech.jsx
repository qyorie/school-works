import Image from 'next/image'

export default function ToolsTech() {
  const tools = [
    'c++', 'react', 'nodejs', 'python', 'postgresql', 
    'git', 'mongodb', 'mysql', 'html5', 'css3', 'js'
  ]

  return (
    <section className="tools-tech">
      <div className="tools-tech-content">
        <div className="tools-stream">
          {[...tools, ...tools].map((tool, index) => (
            <Image 
              key={index}
              src={`/${tool}.png`} 
              alt={tool}
              width={40}
              height={40}
            />
          ))}
        </div>
      </div>
    </section>
  )
}