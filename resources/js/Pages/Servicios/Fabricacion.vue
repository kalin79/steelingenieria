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
        image: "/images/serBan2.png",
        imageM: "/images/serBan2M.png",
        title: `Fabricación <br />Metalmecánica`,
        subtitle: `Fabricación industrial con ingeniería de precisión`,
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
    imagen: `serviciobg2.png`,
    etiqueta: `Fabricación Metalmecánica`,
    title: `Fabricamos soluciones metalmecánicas que responden a las necesidades específicas de cada operación industrial.`,
    descripcion: `Cada proyecto es desarrollado con procesos de manufactura de alta precisión, materiales de calidad y estrictos controles durante todas las etapas de producción. Nuestro compromiso es entregar estructuras y equipos confiables, resistentes y preparados para operar en los entornos más exigentes, contribuyendo a mejorar la productividad, la seguridad y la continuidad operativa de nuestros clientes.`,
};
const serviciosProyectosData = {
    title: `Proyectos destacados`,
    items: [
        {
            imagen: `/images/proyecto4.png`,
            title: `Equipo volteador de block CAT <br />con sistema eléctrico`,
            link: `#`,
        },
        {
            imagen: `/images/proyecto5.png`,
            title: `Herramienta de izaje para <br />camiones Komatsu`,
            link: `#`,
        },
        {
            imagen: `/images/proyecto6.png`,
            title: `Base metálica para conjunto <br />rueda delantero de camión`,
            link: `#`,
        },
    ],
};
const serviciosListadoData = {
    etiqueta: `Fabricación Metalmecánica`,
    title: `¿Qué incluye este <br />servicio?`,
    imagen: `/images/gancho.png`,
    items: [
        {
            icon: `/images/iconser1.svg`,
            title: `Levantamiento y análisis de requerimientos técnicos.`,
        },
        {
            icon: `/images/iconser2.svg`,
            title: `Revisión y validación de planos e ingeniería.`,
        },
        {
            icon: `/images/iconser3.svg`,
            title: `Selección de materiales según las especificaciones del proyecto.`,
        },
        {
            icon: `/images/iconser4.svg`,
            title: `Procesos de corte, conformado, mecanizado y soldadura.`,
        },
        {
            icon: `/images/iconser5.svg`,
            title: `Ensamble y verificación dimensional de los componentes.`,
        },
        {
            icon: `/images/iconser6.svg`,
            title: `Pruebas e inspecciones finales antes de la entrega.`,
        },
        {
            icon: `/images/iconser7.svg`,
            title: `Embalaje y preparación para transporte o instalación en obra.`,
        },
        {
            icon: `/images/iconser8.svg`,
            title: `Mantenimiento mecánico preventivo y correctivo.`,
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
