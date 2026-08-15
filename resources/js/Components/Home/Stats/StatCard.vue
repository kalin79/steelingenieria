<template>
    <div class="stat-card" ref="statCardRef">
        <div class="stat-card__number">
            <span class="stat-card__suffix" v-html="suffix"></span>
            <span ref="numberRef">0</span>
        </div>
        <p class="stat-card__label" v-html="label"></p>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import gsap from "gsap";

const props = defineProps({
    number: {
        type: Number,
        required: true,
    },
    suffix: {
        type: String,
        default: "",
    },
    label: {
        type: String,
        required: true,
    },
    duration: {
        type: Number,
        default: 2, // segundos
    },
});

const statCardRef = ref(null);
const numberRef = ref(null);

onMounted(() => {
    // Usar Intersection Observer para activar animación cuando es visible
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    // Animar número cuando entra en viewport
                    animateNumber();
                    // Dejar de observar después de animar
                    observer.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.5, // Dispara cuando 50% del elemento es visible
        },
    );

    observer.observe(statCardRef.value);
});

const animateNumber = () => {
    // Usar GSAP para animar
    gsap.to(
        { value: 0 },
        {
            value: props.number,
            duration: props.duration,
            ease: "power2.out",
            onUpdate: function () {
                // Actualizar el texto del número
                numberRef.value.textContent = Math.floor(
                    this.targets()[0].value,
                );
            },
        },
    );
};
</script>

<style lang="scss" scoped>
.stat-card {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    gap: 0.5rem;
    @media screen and (min-width: 992px) {
        flex-direction: row;
        align-items: center;
    }
    &__number {
        font-size: 3rem;
        line-height: 1em;
        color: $color-primary;
        font-family: $font-sans;
        font-weight: 300;
        @media screen and (min-width: 992px) {
            font-size: 4rem;
            ine-height: 1em;
        }
        @media screen and (min-width: 1200px) {
            font-size: 5rem;
            ine-height: 1em;
        }
    }

    &__suffix {
        font-size: 3rem;
        color: $color-primary;
        font-family: $font-sans;
        font-weight: 300;
        @media screen and (min-width: 992px) {
            font-size: 4rem;
            ine-height: 1em;
        }
        @media screen and (min-width: 1200px) {
            font-size: 5rem;
            ine-height: 1em;
        }
    }

    &__label {
        font-size: 0.95rem;
        line-height: 1.25em;
        color: white;
        font-family: $font-sans;
        font-weight: 400;
        text-transform: uppercase;
        @media screen and (min-width: 992px) {
            font-size: 1rem;
            line-height: 1.25em;
        }
        @media screen and (min-width: 1200px) {
            font-size: 1.125rem;
            ine-height: 1.15em;
        }
    }
}
</style>
