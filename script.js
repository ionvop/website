window.onscroll = () => {
    let parallax = document.querySelector(".-script__parallax");
    let scrollRatio = document.body.scrollTop / (document.body.scrollHeight - window.innerHeight);
    let heightLimit = parallax.getAttribute("data-height");
    let result = scrollRatio * heightLimit;
    parallax.style.backgroundPositionY = result * 100 + "%";
}

GlobalEventListener("click", ".-script__link", (element, event) => {
    if (event.shiftKey) {
        window.open(element.getAttribute("data-href"));
        return;
    }

    location.href = element.getAttribute("data-href");
});

function AnimatePage(contentTimeline) {
    let headerTimeline = [
        { target: ".-main", type: "-intro__fade" },
        { target: ".-header__content__title", type: "-intro__float__up" },
        { target: ".-header__content__about", type: "-intro__float__left" },
        { target: ".-header__content__contact", type: "-intro__float__left" },
        { target: ".-header__content__sites", type: "-intro__float__left" }
    ]

    let footerTimeline = [
        { target: ".-footer__title", type: "-intro__float__down" },
        { target: ".-footer__home", type: "-intro__float__left" },
        { target: ".-footer__about", type: "-intro__float__left" },
        { target: ".-footer__contact", type: "-intro__float__left" },
        { target: ".-footer__join", type: "-intro__float__left" }
    ]

    let animationTimeline = [...headerTimeline, ...contentTimeline, ...footerTimeline];

    animationTimeline.forEach((animation, index) => {
        let element = document.querySelector(animation.target);
        element.style.animationName = animation.type;
        element.style.animationDuration = "1s";
        element.style.animationDelay = index * 0.1 + "s";
        element.style.animationFillMode = "both";
    })
}

function GlobalEventListener(type, selector, callback) {
    document.addEventListener(type, (event) => {
        if (event.target.closest(selector)) {
            callback(event.target.closest(selector), event);
        }
    });
}