import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/all";

gsap.to('.food-list-scrollTrigger',{
    y:700,
    duration: 3,
    scrollTrigger : '.food-list-scrollTrigger'
})
// const animation = gsap.to('#containerLayout',{
//     x: -1000,
//     duration: 5000,
//     ease: "power2.out"
//     });
//     document.getElementById('containerLayout').addEventListener('load',()=>{
//     animation.play();
// })
gsap.registerPlugin(ScrollTrigger);