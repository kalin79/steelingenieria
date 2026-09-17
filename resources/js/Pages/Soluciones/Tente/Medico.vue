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
import SeparateComponent from "@/Components/Share/Separate.vue";
import LineasComponent from "@/Components/Share/Tente/Lineas.vue";
// import GaleriaComponent from "@/Components/Share/MasterMover/Galeria.vue";
const banners = [
    {
        id: 1,
        image: "/images/bgm.png",
        imageM: "/images/bgm.png",
        title: "Movilidad <br />especializada para <br />equipos médicos",
        subtitle: "Sector Médico",
        description: `Ruedas TENTE para equipos médicos y hospitalarios, con rodadura <br />silenciosa, alta resistencia y movilidad segura.`,
        boton: ``,
        link: ``,
    },
];

const serviciosDescripcionData = {
    imagen: `medi.png`,
    etiqueta: `Sector Médico`,
    title: `Ruedas para Camas Médicas y Camillas`,
    descripcion: `<p>Garantiza una movilidad segura y eficiente en entornos hospitalarios. Las ruedas y aros TENTE para camas médicas y camillas están diseñados para soportar el uso intensivo, ofreciendo desplazamiento suave, silencioso y preciso en diferentes superficies.</p><p>Sus materiales resistentes e higiénicos, junto con sistemas de dirección y frenado confiables, facilitan la maniobrabilidad del personal médico y permiten un mayor control durante el traslado de pacientes. Una solución orientada a hospitales, clínicas y fabricantes de equipamiento médico que buscan seguridad, durabilidad y alto desempeño.</p>`,
};

const Lineas = {
    subtitulo: ``,
    titulo: `Movimiento seguro, <br />operación eficiente`,
    descripcion: `Para hospitales, clínicas y equipamiento médico: movilidad segura, precisión y confiabilidad para una operación eficiente.`,
    productos: [
        {
            imagen: `/images/t24.png`,
            subtitulo: `SERIE INTEGRAL`,
            titulo: `Serie INTEGRAL`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `150 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-30/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `158 - 229 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125 - 200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t25.png`,
            subtitulo: `SERIE INTEGRAL`,
            titulo: `Serie INTEGRAL`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `150 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-30/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `158 - 229 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125 - 200 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t26.png`,
            subtitulo: `SERIE INTEGRAL TWIN`,
            titulo: `Serie INTEGRAL Twin`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `125-150 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-30/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `150 - 175 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125 - 150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t27.png`,
            subtitulo: `SERIE INTEGRAL TWIN`,
            titulo: `Serie INTEGRAL Twin`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `125-150 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-30/+80 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `150 - 175 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `125 - 150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t28.png`,
            subtitulo: `SERIE LUMINA`,
            titulo: `Serie LUMINA`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `40 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `56 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `50 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t29.png`,
            subtitulo: `SERIE LUMINA`,
            titulo: `Serie LUMINA`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `40 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `56 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `50 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t30.png`,
            subtitulo: `SERIE LUMINA`,
            titulo: `Serie LUMINA`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `40 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `71.5 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `50 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t31.png`,
            subtitulo: `LÍNEA LIGHT`,
            titulo: `Serie LÍNEA - 5940`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100-110 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-10/+40 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `124-148 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 125 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t32.png`,
            subtitulo: `LÍNEA LIGHT`,
            titulo: `Serie LÍNEA LIGHT - 5920`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `50-60 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-20/+60 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `55,5-85,5 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `50 - 75 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        // {
        //     imagen: `/images/t32.png`,
        //     subtitulo: `SERIE LEVINA`,
        //     titulo: `Serie LEVINA - 5370`,
        //     items: [
        //         {
        //             titulo: `Capacidad de carga`,
        //             descripcion: `100 KG`,
        //         },
        //         {
        //             titulo: `Temperatura`,
        //             descripcion: `-10/+40 C°`,
        //         },
        //         {
        //             titulo: `Altura total`,
        //             descripcion: `137-190 mm`,
        //         },
        //         {
        //             titulo: `Diametro de rueda`,
        //             descripcion: `100 - 150 mm`,
        //         },
        //         {
        //             titulo: `Soporte`,
        //             descripcion: `Giratorio y con freno`,
        //         },
        //         {
        //             titulo: `Fijación`,
        //             descripcion: ``,
        //         },
        //     ],
        // },
        {
            imagen: `/images/t33.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Serie LEVINA - 5370`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-10/+40 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `137-190 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t34.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Serie LEVINA - 5370`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-10/+40 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `137-190 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t35.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Serie LEVINA - 5370`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-10/+40 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `137-190 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio con freno`,
                },
                {
                    titulo: `Fijación`,
                    descripcion: ``,
                },
            ],
        },
        {
            imagen: `/images/t33.png`,
            subtitulo: `SERIE LEVINA`,
            titulo: `Serie LEVINA - 5370`,
            items: [
                {
                    titulo: `Capacidad de carga`,
                    descripcion: `100 KG`,
                },
                {
                    titulo: `Temperatura`,
                    descripcion: `-10/+40 C°`,
                },
                {
                    titulo: `Altura total`,
                    descripcion: `137-190 mm`,
                },
                {
                    titulo: `Diametro de rueda`,
                    descripcion: `100 - 150 mm`,
                },
                {
                    titulo: `Soporte`,
                    descripcion: `Giratorio`,
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
