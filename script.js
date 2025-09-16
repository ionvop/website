window.addEventListener("scroll", () => {
    UpdateParallax();
});

UpdateParallax();

if (Math.random() < 0.01) {
    setTimeout(() => {
        document.body.style.backgroundImage = "url('assets/bkub_chu2.png')";
        document.body.style.backgroundSize = "20%";
        document.body.style.backgroundPosition = "fixed";
    }, 2000);
}

GlobalEventListener("click", ".-script__link", (element, event) => {
    if (event.shiftKey) {
        window.open(element.getAttribute("data-href"));
        return;
    }

    PreloadPage(element.getAttribute("data-href"));

    if (element.classList.contains("-intro")) {
        element.style.opacity = "";
        element.classList.remove("-intro");
    }

    element.style.filter = "brightness(100%)";

    setTimeout(() => {
        element.style.filter = "brightness(200%)";
    }, 0);

    AnimateOutro(element.getAttribute("data-href"));
});

GlobalEventListener("click", ".-script__new", element => {
    window.open(element.getAttribute("data-href"));
});

async function AnimatePage(contentTimeline) {
    let headerTimeline = [
        { target: ".-main", type: "-intro__fade" },
        { target: ".-header > .content > .title", type: "-intro__float__up" },
        { target: ".-header > .content > .home", type: "-intro__float__left" },
        { target: ".-header > .content > .about", type: "-intro__float__left" },
        { target: ".-header > .content > .contact", type: "-intro__float__left" },
        { target: ".-header > .content > .sites", type: "-intro__float__left" }
    ]

    let footerTimeline = [
        { target: ".-footer > .title", type: "-intro__float__down" },
        { target: ".-footer > .home", type: "-intro__float__left" },
        { target: ".-footer > .about", type: "-intro__float__left" },
        { target: ".-footer > .contact", type: "-intro__float__left" },
        { target: ".-footer > .join", type: "-intro__float__left" }
    ]

    let animationTimeline = [...headerTimeline, ...contentTimeline, ...footerTimeline];

    for (let animation of animationTimeline) {
        let element = document.querySelector(animation.target);
        element.style.opacity = "0%";
    }

    for (let animation of animationTimeline) {
        WaitForElementVisible(animation.target).then(element => {
            element.classList.add("-intro");
            element.classList.add(animation.type);
        });
        
        await new Promise(resolve => setTimeout(resolve, 100));
    }
}

function AnimateOutro(redirect) {
    let main = document.querySelector(".-main");
    let elements = document.querySelectorAll(".-intro");
    main.style.opacity = "100%";
    main.style.animationDelay = "1s";

    let delay = 0;

    for (let element of elements) {
        let animationType = "";

        for (let className of element.classList) {
            if (className.startsWith("-intro__")) {
                animationType = className;
            }
        }

        if (animationType == "") {
            return;
        }

        element.classList.remove(animationType);
        element.style.animationDirection = "reverse";
        
        setTimeout(() => {
            element.classList.add(animationType);
        }, 10);

        delay += 0.1;
    }

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

function ScrollToPosition(element, to, duration = 1000, ease = 'easeInOut') {
    const easingFunctions = {
        easeIn: t => t * t,
        easeOut: t => t * (2 - t),
        easeInOut: t => (t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t)
    };

    const easeFunction = easingFunctions[ease] || easingFunctions['easeInOut'];
    const start = element.scrollTop;
    const totalDistance = element.scrollHeight - element.clientHeight;
    const targetPosition = totalDistance * to;
    const distance = targetPosition - start;
    const startTime = performance.now();

    function animateScroll(currentTime) {
        const elapsedTime = currentTime - startTime;
        const progress = Math.min(elapsedTime / duration, 1); // Clamp progress to [0, 1]
        const easedProgress = easeFunction(progress);

        element.scrollTop = start + distance * easedProgress;

        if (progress < 1) {
            requestAnimationFrame(animateScroll);
        }
    }

    requestAnimationFrame(animateScroll);
}

function UpdateParallax() {
    let parallaxes = document.querySelectorAll(".-script__parallax");

    if (window.matchMedia("(orientation: portrait)").matches) {
        return;
    }

    for (let parallax of parallaxes) {
        let offset = (parallax.getAttribute("data-offset") != null) ? parallax.getAttribute("data-offset") : 0;
        parallax.style.backgroundPositionY = document.body.scrollTop * 0.7 + parseFloat(offset) + "px";
    }
}

function WaitForElementVisible(selector, options = {}) {
    return new Promise(resolve => {
        const element = document.querySelector(selector);

        // If element exists and is already visible
        if (element) {
            const rect = element.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
            if (isVisible) {
                return resolve(element);
            }
        }

        // Otherwise, observe until visible
        const observer = new IntersectionObserver(entries => {
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    observer.disconnect();
                    resolve(entry.target);
                }
            }
        }, options);

        if (element) {
            observer.observe(element);
        } else {
            // fallback if element doesn't exist yet
            const mo = new MutationObserver(() => {
                const el = document.querySelector(selector);
                if (el) {
                    mo.disconnect();
                    observer.observe(el);
                }
            });
            mo.observe(document.body, { childList: true, subtree: true });
        }
    });
}

function ElementFromHTML(html) {
    let template = document.createElement("template");
    template.innerHTML = html;
    return template.content.firstElementChild;
}