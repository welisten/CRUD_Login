const $labels = document.querySelectorAll(".form-control label")
const delayScale = 50
$labels.forEach(label => {
    label.innerHTML = label.innerText
    .split('')
    .map((letter, idx) => `<span style="transition-delay: ${idx * delayScale}ms">${letter}</span>`)
    .join('')
})