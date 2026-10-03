const { Client, GatewayIntentBits } = require('discord.js');
const axios = require('axios');

const client = new Client({
    intents: [
        GatewayIntentBits.Guilds,
        GatewayIntentBits.GuildMessages,
        GatewayIntentBits.MessageContent
    ]
});

// URL del Webhook que copiaste de n8n
const N8N_WEBHOOK_URL = '<WEBHOOK_URL>';

client.on('ready', () => {
    console.log(`Bot conectado como ${client.user.tag}`);
});

client.on('messageCreate', async (message) => {
    // Ignora mensajes del propio bot
    if (message.author.bot) return;

    // Revisa si el mensaje incluye una imagen (attachment)
    if (message.attachments.size > 0) {
        const attachment = message.attachments.first();
        
        console.log('Imagen detectada, enviando a n8n...');

        try {
            // Envía los datos relevantes (URL de la imagen y texto) por POST a n8n
            await axios.post(N8N_WEBHOOK_URL, {
                imageUrl: attachment.url,
                user: message.author.username,
                content: message.content
            });

            message.reply('¡Imagen recibida! Procesando con IA...');
        } catch (error) {
            console.error('Error al enviar al webhook de n8n:', error);
        }
    }
});

// Reemplaza con el Token de tu Bot de Discord
client.login('<BOT_TOKEK>');
