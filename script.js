window.onscroll = () => {
    UpdateParallax();
}

UpdateParallax();

function UpdateParallax() {
    let parallax = document.querySelector(".-script__parallax");
    parallax.style.backgroundPositionY = document.body.scrollTop * 0.7 + "px";
}

GlobalEventListener("click", ".-script__link", (element, event) => {
    if (event.shiftKey) {
        window.open(element.getAttribute("data-href"));
        return;
    }

    PreloadPage(element.getAttribute("data-href"));

    if (element.classList.contains("-intro")) {
        element.classList.remove("-intro");
    }

    element.style.transitionDuration = "1s";
    element.style.filter = "blur(0rem)";
    element.style.opacity = "100%";

    setTimeout(() => {
        element.style.filter = "blur(1rem)";
        element.style.opacity = "0%";
    }, 0);

    AnimateOutro(element.getAttribute("data-href"));
});

GlobalEventListener("click", ".-script__new", element => {
    window.open(element.getAttribute("data-href"));
});

function PreloadPage(url) {
    fetch(url, {
        method: "GET",
        credentials: "include"
    }).then(response => {
        if (!response.ok) {
            console.error(`Failed to preload page: ${response.statusText}`);
            return;
        }

        return response.text();
    }).then(content => {
        // Optionally, store the content or handle it as needed
        console.log("Page preloaded:", url);
    }).catch(error => {
        console.error("Error preloading page:", error);
    });
}

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
    let delay = 0;

    animationTimeline.forEach((animation) => {
        let element = document.querySelector(animation.target);
        element.style.animationDelay = delay + "s";
        element.classList.add("-intro");
        element.classList.add(animation.type);
        delay += 0.1;
    });
}

function AnimateOutro(redirect) {
    let main = document.querySelector(".-main");
    let elements = document.querySelectorAll(".-intro");
    main.style.opacity = "100%";
    main.style.animationDelay = "1s";

    let delay = 0;

    elements.forEach((element) => {
        let animationType = "";

        element.classList.forEach((className) => {
            if (className.startsWith("-intro__")) {
                animationType = className;
            }
        });

        if (animationType == "") {
            return;
        }

        element.classList.remove(animationType);
        element.style.animationDirection = "reverse";
        
        setTimeout(() => {
            element.classList.add(animationType);
        }, 10);

        delay += 0.1;
    });

    setTimeout(() => {
        location.href = redirect;
    }, 2000);
}

function GlobalEventListener(type, selector, callback) {
    document.addEventListener(type, (event) => {
        if (event.target.closest(selector)) {
            callback(event.target.closest(selector), event);
        }
    });
}