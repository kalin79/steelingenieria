<template>
    <AppLayout>
        <Hero :slides="banners" />
        <TenteComponent />
        <DescripcionComponent :dataDescripcion="serviciosDescripcionData" />
        <LineasComponent :lineas="Lineas" />
        <!-- <GaleriaComponent :galerias="Galerias" /> -->
        <!-- <SeparateComponent /> -->
        <ContactoComponent />
    </AppLayout>
</template>
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Hero from "@/Components/Hero.vue";
import ContactoComponent from "@/Components/Share/Atencion.vue";
import DescripcionComponent from "@/Components/Tente/Descripcion.vue";
import TenteComponent from "@/Components/Share/Tente.vue";
import SeparateComponent from "@/Components/Share/Separate.vue";
import LineasComponent from "@/Components/Share/Tente/Lineas.vue";
// import GaleriaComponent from "@/Components/Share/MasterMover/Galeria.vue";
const banners = [
    {
        id: 1,
        image: "/images/bgt1.png",
        imageM: "/images/bgt1.png",
        title: "Más carga. Más eficiencia. <br />Más productividad.",
        subtitle: "Sector Industrial",
        description: `Ruedas TENTE de alto desempeño para soportar cargas exigentes y optimizar la movilidad en plantas, almacenes y centros logísticos.`,
        boton: ``,
        link: ``,
    },
];

const serviciosDescripcionData = {
    imagen: `supe2.png`,
    etiqueta: `Sector Industrial`,
    title: `Movilidad eficiente en cada maniobra`,
    descripcion: `<p>Las ruedas TENTE están diseñadas para facilitar el desplazamiento de carros y equipos industriales, proporcionando una maniobrabilidad precisa, estable y segura incluso en entornos de trabajo exigentes. Su baja resistencia a la rodadura permite mover cargas con menor esfuerzo, mientras que su construcción robusta garantiza un funcionamiento confiable durante largas jornadas de trabajo.</p> <p>La combinación de estabilidad, suavidad de movimiento y capacidad de carga ayuda a optimizar las operaciones internas, reducir el esfuerzo del operario y mejorar la eficiencia en procesos de producción, mantenimiento, almacenamiento y transporte de materiales.</p>`,
};

const Lineas = {
    subtitulo: ``,
    titulo: `Movimiento seguro, <br />operación eficiente`,
    descripcion: `Para industria, almacenes y logística: soluciones de movilidad de alto desempeño para optimizar procesos y reducir costos operativos.`,
    productos: [
        {
            imagen: `/images/t5.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Rueda giratoria Rueda 125 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `200 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t6.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Rueda giratoria con Freno total 125 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `275 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t7.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Rueda giratoria  con Freno total 125 mm `,
            items: [
                {
                    titulo: `Modelo`,
                    descripcion: `<span>QAP</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `125 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `300 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t8.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Rueda giratoria  200 mm`,
            items: [
                {
                    titulo: `Modelo`,
                    descripcion: `<span>PJP</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `200 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `350 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t9.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Rueda fija 100 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `100 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `160 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fija`,
                },
            ],
        },
        {
            imagen: `/images/t10.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Rueda giratoria  100 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Termorresistencia</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `100 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `125 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
            ],
        },
        {
            imagen: `/images/t11.png`,
            subtitulo: `SERIE ALPHA INOX`,
            titulo: `Rueda giratoria con Freno total 200 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `200 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `350 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
            ],
        },
        {
            imagen: `/images/t12.png`,
            subtitulo: `SERIE ALPHA INOX`,
            titulo: `Rueda fija 160 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `160 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `500 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo`,
                },
            ],
        },
        {
            imagen: `/images/t13.png`,
            subtitulo: `SERIE OMIKRON`,
            titulo: `Rueda giratoria  300 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `300 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `3120 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fija`,
                },
            ],
        },
        {
            imagen: `/images/t14.png`,
            subtitulo: `SERIE OMIKRON`,
            titulo: `Rueda giratoria  200 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `300 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `2500 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria`,
                },
            ],
        },
        {
            imagen: `/images/t15.png`,
            subtitulo: `SERIE NOVATECH`,
            titulo: `Aro 80 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `80 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `560 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria`,
                },
            ],
        },
        {
            imagen: `/images/t16.png`,
            subtitulo: `SERIE NOVATECH`,
            titulo: `Aro 250 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `250 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `2000 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria`,
                },
            ],
        },
        {
            imagen: `/images/t17.png`,
            subtitulo: `SERIE ELASTECH`,
            titulo: `Aro 160 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Neumático elástico</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `160 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `700 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria`,
                },
            ],
        },
        {
            imagen: `/images/t18.png`,
            subtitulo: `SERIE KAPPA`,
            titulo: `Rueda giratoria Rueda 80 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano, Fundido</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `80 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `600 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria`,
                },
            ],
        },
        {
            imagen: `/images/t19.png`,
            subtitulo: `SERIE KAPPA`,
            titulo: `Rueda fija 150 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano, Fundido</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `150 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `650 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fija`,
                },
            ],
        },
        {
            imagen: `/images/t20.png`,
            subtitulo: `SERIE KAPPA`,
            titulo: `Rueda giratoria con Freno total 200 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano, pesada</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `200 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `1200 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria con freno`,
                },
            ],
        },
        {
            imagen: `/images/t21.png`,
            subtitulo: `SERIE ZETA`,
            titulo: `Rueda giratoria con Freno total 200 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliamida</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `200 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `600 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria con freno`,
                },
            ],
        },
        {
            imagen: `/images/t22.png`,
            subtitulo: `SERIE ZETA`,
            titulo: `Rueda fija 250 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Neumático elástico</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `250 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `500 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fija`,
                },
            ],
        },
        {
            imagen: `/images/t23.png`,
            subtitulo: `SERIE ZETA`,
            titulo: `Rueda giratoria  160 mm`,
            items: [
                {
                    titulo: `Material`,
                    descripcion: `<span>Poliuretano</span>`,
                },
                {
                    titulo: `Diámetro`,
                    descripcion: `160 mm`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: `P30 - 13`,
                },
                {
                    titulo: `Capacidad`,
                    descripcion: `800 KG.`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratoria`,
                },
            ],
        },
    ],
};

const Galerias = {
    subtitulo: ``,
    titulo: `Así trabaja nuestra gama <br />MasterTow`,
    descripcion: ``,
    fotos: [
        {
            imagen: `/images/foto6.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto9.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto8.png`,
            alt: ``,
            destacado: true,
        },
        {
            imagen: `/images/foto7.png`,
            alt: ``,
            destacado: false,
        },
        {
            imagen: `/images/foto10.png`,
            alt: ``,
            destacado: false,
        },
    ],
};
</script>
