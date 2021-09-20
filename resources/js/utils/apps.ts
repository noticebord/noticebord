import { App } from "../models/App";

const apps: App[] = [
    {
        id: "web",
        name: "Noticebord Web",
        description: "Use Noticebord on the web!",
        platforms: ["Web"],
        source: "https://github.com/sixpeteunder/noticebord"
    },
    {
        id: "app",
        name: "Noticebord App",
        description: "Get the native app for your phone/PC.",
        platforms: ["Android", "iOS", "Windows", "macOS", "Linux"],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        id: "lite",
        name: "Noticebord Lite",
        description: "Get the lightweight app for your phone/PC.",
        platforms: ["Android", "iOS", "Windows", "macOS", "Linux"],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        id: "cli",
        name: "Noticebord CLI",
        description: "Use Noticebord from the terminal.",
        platforms: ["Android", "iOS", "Windows", "macOS", "Linux"],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        id: "bot",
        name: "Noticebort",
        description: "Have a chat with Noticebort in your favourite messaging app.",
        platforms: ["Telegram", "Facebook Messenger", "Discord"],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        id: "browser",
        name: "Noticebord Chrome Extension",
        description: "Create notices inside your favourite browser.",
        platforms: ["Chrome"],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    },
    {
        id: "vscode",
        name: "Noticebord VS Code Extension",
        description: "Integrate Noticebord with your favourite editor.",
        platforms: ["VS Code"],
        source: "https://github.com/sixpeteunder/noticebord-clients"
    }
]

const libraries: any[] = [
    {
        id: "noticebord-ts",
        platform: "TypeScript",
        icon: "devicon-typescript-plain",
        color: "#007acc",
        source: "https://github.com/sixpeteunder/noticebord",
        registry: "NPM",
        package: "https://github.com/sixpeteunder/noticebord",
        command: "npm install noticebord-client"
    },
    {
        id: "noticebord-dotnet",
        platform: ".NET",
        icon: "devicon-dotnetcore-plain",
        color: "#623697",
        source: "https://github.com/sixpeteunder/noticebord",
        registry: "NuGet",
        package: "https://github.com/sixpeteunder/noticebord",
        command: "dotnet add package Noticebord.Client"
    },
    {
        id: "noticebord-php",
        platform: "PHP",
        icon: "devicon-php-plain",
        color: "#6181b6",
        source: "https://github.com/sixpeteunder/noticebord",
        registry: "Packagist",
        package: "https://github.com/sixpeteunder/noticebord",
        command: "composer require noticebord/client"
    },
    {
        id: "noticebord-go",
        platform: "Golang",
        icon: "devicon-go-plain",
        color: "#00acd7",
        registry: "pkg.go.dev",
        source: "https://github.com/sixpeteunder/noticebord",
        package: "https://github.com/sixpeteunder/noticebord",
        command: "go get github.com/sixpeteunder/noticebord-go"
    }
]

export function getApps(): App[] {
    return apps;
}

export function getLibraries(): any[] {
    return libraries;
}