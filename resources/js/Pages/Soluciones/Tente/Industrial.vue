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
import ContactoComponent from "@/Components/Share/ContactoTente.vue";
import DescripcionComponent from "@/Components/Tente/Descripcion.vue";
import TenteComponent from "@/Components/Share/Tente.vue";
// import SeparateComponent from "@/Components/Share/Separate.vue";
import LineasComponent from "@/Components/Share/Tente/Lineas.vue";
// import GaleriaComponent from "@/Components/Share/MasterMover/Galeria.vue";
const banners = [
    {
        id: 1,
        image: "/images/bgt1.png",
        imageM: "/images/bgt1.png",
        title: "Más carga. Más eficiencia. <br />Más productividad.",
        subtitle: "Sector Industrial",
        description: `Ruedas TENTE de alto desempeño para soportar cargas exigentes y <br />optimizar la movilidad en plantas, almacenes y centros logísticos.`,
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
            titulo: `Serie ALPHA inox - 8470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 - 350 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `108 - 240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `80-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t6.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Serie ALPHA inox - 8470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `200 - 500 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `108 - 240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `80-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t7.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Serie ALPHA 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `200 - 350 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `125 - 240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t8.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Serie ALPHA 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `200 - 350 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+85 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `125 - 240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t9.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Serie ALPHA - 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `200 - 250 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `128 - 155 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100-125 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t10.png`,
            subtitulo: `SERIE ALPHA`,
            titulo: `Serie ALPHA - 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 - 150 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+280 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `108 - 128 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `80-100 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t11.png`,
            subtitulo: `SERIE ALPHA INOX`,
            titulo: `Serie ALPHA - 3470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 - 350 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `108 - 240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `80-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t12.png`,
            subtitulo: `SERIE ALPHA INOX`,
            titulo: `Serie ALPHA - 8470`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `230 - 500 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-30/+180 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `161 - 195 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125-150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo y giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t13.png`,
            subtitulo: `SERIE OMIKRON`,
            titulo: `Serie OMIKRON twin 9950 Shore D75 `,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `1200-2200 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `180 - 325 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 250 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo y giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t14.png`,
            subtitulo: `SERIE OMIKRON`,
            titulo: `Serie OMIKRON twin 9950 Shore 92A`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `1080-4800 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `180 - 415 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 300 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo y giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t15.png`,
            subtitulo: `SERIE NOVATECH`,
            titulo: `Rodillos de doble rodamiento para transportar palets`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `240 - 900 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: ``,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `65-140 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: ``,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t16.png`,
            subtitulo: `SERIE NOVATECH`,
            titulo: `Timoneras para transportar palets`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `350 - 800 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+85 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: ``,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `150-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: ``,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t17.png`,
            subtitulo: `SERIE ELASTECH`,
            titulo: `Timoneras para transportar palets`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `350 - 800 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+85 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: ``,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `150-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: ``,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t18.png`,
            subtitulo: `SERIE KAPPA`,
            titulo: `Serie KAPPA 9650-Shore 92A`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `1000-2000 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `245-355 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `200-300 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t19.png`,
            subtitulo: `SERIE KAPPA`,
            titulo: `Serie KAPPA 9650-Shore 92A`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `1000-2000 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `245-355 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `200-300 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t20.png`,
            subtitulo: `SERIE KAPPA`,
            titulo: `Serie KAPPA 9680-Shore D75`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `1000-2000 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `245-355 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `200-300 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t21.png`,
            subtitulo: `SERIE ZETA`,
            titulo: `Serie ZETA 4680 - Shore D75`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `700 - 800 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-40/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `164 - 290 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125-250 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t22.png`,
            subtitulo: `SERIE ZETA`,
            titulo: `Serie ZETA 4680 Shore 804 CONVEX`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `500 - 800 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `164 - 240 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t23.png`,
            subtitulo: `SERIE ZETA`,
            titulo: `Serie ZETA 4680 Shore 92A`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `500 - 800 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `164 - 290 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125-200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Fijo, giratorio y con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
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
