import About from "./components/About.jsx";
import Contact from "./components/Contact.jsx";
import Hero from "./components/Hero.jsx"
import Portfolio from "./components/Portfolio.jsx";
import Skills from "./components/Skills.jsx"
import ToolsTech from "./components/ToolsTech.jsx";

export default function Home() {
  return (
    <>
      <Hero />
      <ToolsTech />
      <Skills />
      <Portfolio />
      <About />
      <Contact />
    </>
  );
}
