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
        image: "/images/serBan1.png",
        imageM: "/images/serBan1.png",
        title: "Montajes y Mantenimiento <br />Metálico",
        subtitle:
            "Instalamos, mantenemos y optimizamos estructuras <br />que impulsan tu operación",
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
    imagen: `serviciobg.png`,
    etiqueta: `Montaje y Mantenimiento Metálico`,
    title: `Ejecutamos servicios de montaje y mantenimiento mecánico con un enfoque integral, asegurando que cada instalación se realice de manera segura, eficiente y dentro de los plazos establecidos.`,
    descripcion: `Nuestro equipo técnico trabaja bajo rigurosos estándares de calidad y seguridad, garantizando que cada estructura, equipo o sistema quede completamente operativo y alineado con las necesidades de producción de nuestros clientes. Más que instalar, nos enfocamos en asegurar la confiabilidad y el desempeño de cada proyecto industrial.`,
};
const serviciosProyectosData = {
    title: `Proyectos destacados`,
    items: [
        {
            imagen: `/images/proyecto1.png`,
            title: `Instalación de barandas y <br />escalera en la azotea de <br />Cinepolis Mall Sta. Anita.`,
            link: `#`,
        },
        {
            imagen: `/images/proyecto2.png`,
            title: `Montaje de barandas en muros <br />Jersey.`,
            link: `#`,
        },
        {
            imagen: `/images/proyecto3.png`,
            title: `Montaje de brazo de izaje - línea <br />extrusión Tigre Perú tubos y <br />conexiones S.A.`,
            link: `#`,
        },
    ],
};
const serviciosListadoData = {
    etiqueta: `Montajes y Mantenimiento Metálico`,
    title: `¿Qué incluye este <br />servicio?`,
    imagen: `/images/gancho.png`,
    items: [
        {
            icon: `/images/iconser1.svg`,
            title: `Planificación técnica y coordinación de las actividades de montaje.`,
        },
        {
            icon: `/images/iconser2.svg`,
            title: `Gestión integral de recursos humanos y equipos especializados.`,
        },
        {
            icon: `/images/iconser3.svg`,
            title: `Supervisión permanente para garantizar calidad, seguridad y cumplimiento.`,
        },
        {
            icon: `/images/iconser4.svg`,
            title: `Ejecución de trabajos bajo procedimientos certificados y buenas prácticas industriales.`,
        },
        {
            icon: `/images/iconser5.svg`,
            title: `Cumplimiento de protocolos SSOMA y normativas vigentes.`,
        },
        {
            icon: `/images/iconser6.svg`,
            title: `Pruebas funcionales y puesta en operación de las instalaciones.`,
        },
        {
            icon: `/images/iconser7.svg`,
            title: `Mantenimiento preventivo y correctivo para garantizar la continuidad operativa.`,
        },
        {
            icon: `/images/iconser8.svg`,
            title: `Entrega técnica del proyecto con verificación final y conformidad del cliente.`,
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
