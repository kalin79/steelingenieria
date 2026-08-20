<template>
    <AppLayout>
        <Hero :slides="banners" />
        <DatosSection :stats="statsData" />
        <DescripcionComponent :dataDescripcion="serviciosDescripcionData" />
        <ListadoComponent :dataListado="serviciosListadoData" />
        <ProyectoComponent :dataProyecto="serviciosProyectosData" />
        <ContactoComponent />
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import DatosSection from "@/Components/Home/Datos.vue";
import ContactoComponent from "@/Components/Share/Contacto.vue";
import DescripcionComponent from "@/Components/Servicios/Descripcion.vue";
import ListadoComponent from "@/Components/Servicios/Listado.vue";
import ProyectoComponent from "@/Components/Servicios/Proyecto.vue";
// Recibir props del controller
// defineProps({
//     banners: {
//         type: Array,
//         default: () => [],
//     },
// });
// Datos hardcodeados por ahora
const banners = [
    {
        id: 1,
        image: "/images/serBan3.png",
        imageM: "/images/serBan3M.png",
        title: `Ingeniería y Diseño`,
        subtitle: `Transformamos ideas en soluciones industriales <br />de alto rendimiento.`,
        description: ``,
        boton: ``,
        link: ``,
    },
];
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
const serviciosDescripcionData = {
    imagen: `serviciobg3.png`,
    etiqueta: `Ingeniería y Diseño`,
    title: `En STEEL Ingeniería convertimos los desafíos de nuestros clientes en soluciones de ingeniería eficientes, seguras y listas para hacerse realidad.`,
    descripcion: `Analizamos cada proyecto desde una perspectiva técnica y funcional para desarrollar diseños que optimicen los procesos, reduzcan riesgos y garanticen la viabilidad de la fabricación e instalación. Nuestra experiencia nos permite diseñar soluciones personalizadas que responden a las exigencias de la industria moderna, priorizando la innovación, la precisión y el cumplimiento de los más altos estándares de calidad.`,
};
const serviciosProyectosData = {
    title: `Proyectos destacados`,
    items: [
        {
            imagen: `/images/proyecto7.png`,
            title: `Equipo volteador de block CAT <br />con sistema eléctrico`,
            link: `#`,
        },
        {
            imagen: `/images/proyecto8.png`,
            title: `Herramienta de izaje para <br />camiones Komatsu`,
            link: `#`,
        },
        {
            imagen: `/images/proyecto9.png`,
            title: `Base metálica para conjunto <br />rueda delantero de camión`,
            link: `#`,
        },
    ],
};
const serviciosListadoData = {
    etiqueta: `Ingeniería y Diseño`,
    title: `¿Qué incluye este <br />servicio?`,
    imagen: `/images/gancho.png`,
    items: [
        {
            icon: `/images/iconser2.svg`,
            title: `Ingeniería conceptual, básica y de detalle.`,
        },
        {
            icon: `/images/iconser2.svg`,
            title: `Desarrollo de ingeniería de taller.`,
        },
        {
            icon: `/images/iconser3.svg`,
            title: `Elaboración de planos de fabricación y montaje.`,
        },
        {
            icon: `/images/iconser2.svg`,
            title: `Modelado CAD 2D y 3D.`,
        },
        {
            icon: `/images/iconser2.svg`,
            title: `Memorias de cálculo estructural.`,
        },
        {
            icon: `/images/iconser6.svg`,
            title: `Análisis por Elementos Finitos (FEA).`,
        },
        {
            icon: `/images/iconser2.svg`,
            title: `Diseño de herramientas especiales.`,
        },
        {
            icon: `/images/iconser8.svg`,
            title: `Diseño de equipos de izaje.`,
        },
        {
            icon: `/images/iconser3.svg`,
            title: `Optimización de soluciones para fabricación y montaje.`,
        },
    ],
};
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
