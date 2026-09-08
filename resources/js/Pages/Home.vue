<template>
    <AppLayout>
        <Hero :slides="slidesHero" />
        <DatosSection :stats="statsData" />
        <SomosSection />
        <ServiciosSection />
        <SociosSection />
        <ProyectosSection :proyectos="proyectos" />
        <ContactoComponent />
    </AppLayout>
</template>

<script setup>
import { computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import DatosSection from "@/Components/Home/Datos.vue";
import SomosSection from "@/Components/Home/Somos.vue";
import ServiciosSection from "@/Components/Home/Servicios.vue";
import SociosSection from "@/Components/Home/Socios.vue";
import ProyectosSection from "@/Components/Home/Proyectos.vue";
import ContactoComponent from "@/Components/Share/Contacto.vue";

/*
 * Datos que llegan del controlador:
 *   banners   -> Banner::paraHero('home')
 *   proyectos -> Project::ultimos(5)
 */
const props = defineProps({
    banners: { type: Array, default: () => [] },
    proyectos: { type: Array, default: () => [] },
});

/*
 * Respaldo mientras no haya banners cargados en el panel con la
 * agrupacion "home".
 *
 * Hero declara un default en su prop, pero un default solo actua cuando
 * la prop NO se pasa: al recibir un arreglo vacio no se activa y el
 * carrusel queda en blanco. Como el hero es lo primero que se ve del
 * sitio, la decision se toma aca y no dentro de Hero, que lo comparten
 * otras catorce paginas.
 */
const bannersPorDefecto = [
    {
        id: 1,
        image: "/images/hero2.webp",
        imageM: "/images/bm.webp",
        title: "Soluciones <br />Industriales",
        subtitle: "Soluciones digitales innovadoras",
        description: `Diseño, fabricación y montaje de proyectos industriales para <br />los sectores minero, logístico, manufacturero y alimentario.`,
        boton: `SOLICITA UNA COTIZACIÓN`,
        link: `/contacto`,
    },
];

const slidesHero = computed(() =>
    props.banners.length ? props.banners : bannersPorDefecto,
);

const statsData = [
    {
        id: 1,
        number: 15,
        suffix: "+",
        label: "Años de <br />Experiencia",
        duration: 2,
    },
    {
        id: 2,
        number: 500,
        suffix: "+",
        label: "Proyectos <br />Ejecutados",
        duration: 2.5,
    },
    {
        id: 3,
        number: 300,
        suffix: "+",
        label: "Clientes <br />Atendidos",
        duration: 2.5,
    },
];
</script>

<style lang="scss" scoped>
.hero {
    text-align: center;
    padding: $spacing-3xl $spacing-md;

    &__title {
        font-size: $font-size-4xl;
        font-weight: $font-weight-bold;
        color: $color-secondary;
        margin-bottom: $spacing-md;
        line-height: $line-height-tight;
    }

    &__subtitle {
        font-size: $font-size-xl;
        color: $color-text-light;
        margin-bottom: $spacing-xl;
    }

    &__cta {
        background: $color-primary;
        color: $color-white;
        padding: $spacing-md $spacing-2xl;
        border-radius: $radius-md;
        font-weight: $font-weight-bold;
        border: none;
        cursor: pointer;
        transition: all $transition-base;

        &:hover {
            background: $color-primary-dark;
            box-shadow: $shadow-lg;
            transform: translateY(-4px);
        }
    }
}

.services {
    padding: $spacing-2xl $spacing-md;

    h2 {
        font-size: $font-size-3xl;
        font-weight: $font-weight-bold;
        text-align: center;
        margin-bottom: $spacing-2xl;
        color: $color-secondary;
    }
}

.services__grid {
    @include grid-auto(280px, $spacing-lg);
}
</style>
