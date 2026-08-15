<template>
    <section class="stats-section">
        <div class="stats-container">
            <StatCard
                v-for="stat in stats"
                :key="stat.id"
                :number="stat.number"
                :suffix="stat.suffix"
                :label="stat.label"
                :duration="stat.duration || 2"
            />
        </div>
    </section>
</template>

<script setup>
import StatCard from "./Stats/StatCard.vue";

defineProps({
    stats: {
        type: Array,
        default: () => [
            {
                id: 1,
                number: 15,
                suffix: "+",
                label: "Años de Experiencia",
                duration: 2,
            },
            {
                id: 2,
                number: 500,
                suffix: "+",
                label: "Proyectos Ejecutados",
                duration: 2.5,
            },
            {
                id: 3,
                number: 300,
                suffix: "+",
                label: "Clientes Atendidos",
                duration: 2.5,
            },
        ],
    },
});
</script>

<style lang="scss" scoped>
.stats-section {
    background: $color-primary-dark;
    padding: 3rem 2rem;
    position: relative;

    // Efecto de fondo
    &::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(
                circle at 20% 50%,
                rgba($color-primary, 0.1) 0%,
                transparent 50%
            ),
            radial-gradient(
                circle at 80% 50%,
                rgba($color-primary, 0.1) 0%,
                transparent 50%
            );
        pointer-events: none;
    }
}

.stats-container {
    position: relative;
    z-index: 1;
    max-width: $max-width-container;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;

    // @include respond-to("sm") {
    //     grid-template-columns: 1fr;
    //     gap: $spacing-lg;
    // }
}
</style>
