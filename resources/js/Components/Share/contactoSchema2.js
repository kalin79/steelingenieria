import { z } from "zod";
import { toTypedSchema } from "@vee-validate/zod";



const aE164 = (v) => "+51" + v.replace(/[\s().-]/g, "").replace(/^\+?51/, "");

export const contactoSchema2 = toTypedSchema(
    z.object({
        nombres: z
            .string({ required_error: "Ingresa tus nombres o razón social" })
            .trim()
            .min(1, "Ingresa tus nombres o razón social")
            .min(3, "Debe tener al menos 3 caracteres")
            .max(120, "Máximo 120 caracteres"),

        email: z
            .string({ required_error: "Ingresa tu correo electrónico" })
            .trim()
            .toLowerCase()
            .min(1, "Ingresa tu correo electrónico")
            .email("Ingresa un correo electrónico válido")
            .max(150, "Máximo 150 caracteres"),

        celular: z
            .string({ required_error: "Ingresa tu número de celular" })
            .trim()
            .min(1, "Ingresa tu número de celular")
            .regex(
                /^(\+?51)?[\s.-]?9\d{2}[\s.-]?\d{3}[\s.-]?\d{3}$/,
                "Ingresa un celular válido (9 dígitos, empieza con 9)",
            )
            .transform(aE164),

        empresa: z
            .string({ required_error: "Ingresa el nombre de tu empresa" })
            .trim()
            .min(1, "Ingresa el nombre de tu empresa")
            .min(2, "Debe tener al menos 2 caracteres")
            .max(120, "Máximo 120 caracteres"),
        proyecto: z
            .string({ required_error: "Describe brevemente tu proyecto" })
            .trim()
            .min(1, "Describe brevemente tu proyecto")
            .min(20, "Cuéntanos un poco más (mínimo 20 caracteres)")
            .max(1000, "Máximo 1000 caracteres"),

        privacidad: z.literal(true, {
            errorMap: () => ({
                message: "Debes aceptar la política de privacidad",
            }),
        }),
    }),
);
