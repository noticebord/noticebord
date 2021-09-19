import { App } from "../models/App";

const apps: App[] = [
    {
        name: "Noticebord Web App",
        description: "Use Noticebord on the web!",
        platforms: [ "Web" ],
        source: "https://github.com/sixpeteunder/noticebord"
    },
    {
        name: "Noticebord",
        description: "Get the native app for your phone/PC.",
        platforms: [ "Android", "iOS", "Windows", "macOS", "Linux" ],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        name: "Noticebord Lite",
        description: "Get the lightweight app for your phone/PC.",
        platforms: [ "Android", "iOS", "Windows", "macOS", "Linux" ],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        name: "Noticebord CLI",
        description: "Use Noticebord from the terminal.",
        platforms: [ "Android", "iOS", "Windows", "macOS", "Linux" ],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        name: "Noticebort",
        description: "Have a chat with Noticebort in your favourite messaging app.",
        platforms: [ "Telegram", "Facebook Messenger", "Discord" ],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        name: "Noticebord Browser Extension",
        description: "Create notices right from your favourite browser.",
        platforms: [ "Chrome", "Edge", "Vivaldi" ],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        name: "Noticebord VS Code Extension",
        description: "Integrate Noticebord with your favourite editor.",
        platforms: [ "Android", "iOS" ],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    }
]

export function getApps(): App[] {
    return apps;
}