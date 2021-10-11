import { App, Library } from "../models";

const apps: App[] = [
    {
        id: "web",
        name: "Noticebord Web",
        description: "Use Noticebord on the web!",
        platforms: ["Web"],
        source: "https://github.com/noticebord/noticebord"
    },
    {
        id: "app",
        name: "Noticebord App",
        description: "Get the native app for your phone/PC.",
        platforms: ["Android", "iOS", "Windows", "macOS", "Linux"],
        source: "https://github.com/noticebord/noticebord-clients"
    },
    {
        id: "lite",
        name: "Noticebord Lite",
        description: "Get the lightweight app for your phone/PC.",
        platforms: ["Android", "iOS", "Windows", "macOS", "Linux"],
        source: "https://github.com/noticebord/noticebord-clients"
    },
    {
        id: "cli",
        name: "Noticebord CLI",
        description: "Use Noticebord from the terminal.",
        platforms: ["Windows", "macOS", "Linux"],
        source: "https://github.com/noticebord/noticebord-clients"
    },
    {
        id: "bot",
        name: "Noticebort",
        description: "Have a chat with Noticebort in your favourite messaging app.",
        platforms: ["Telegram", "Facebook Messenger", "Discord"],
        source: "https://github.com/noticebord/noticebord-clients"
    },
    {
        id: "browser",
        name: "Noticebord Chrome Extension",
        description: "Create notices inside your favourite browser.",
        platforms: ["Chrome"],
        source: "https://github.com/noticebord/noticebord-clients"
    },
    {
        id: "vscode",
        name: "Noticebord VS Code Extension",
        description: "Integrate Noticebord with your favourite editor.",
        platforms: ["VS Code"],
        source: "https://github.com/noticebord/noticebord-clients"
    }
]

const libraries: Library[] = [
    {
        id: "noticebord-ts",
        platform: "TypeScript",
        icon: "devicon-typescript-plain",
        color: "#007acc",
        source: "https://github.com/noticebord/noticebord-client-ts",
        registry: "NPM",
        package: "https://github.com/noticebord/noticebord",
        command: "npm install noticebord-client"
    },
    {
        id: "noticebord-dotnet",
        platform: ".NET",
        icon: "devicon-dotnetcore-plain",
        color: "#623697",
        source: "https://github.com/noticebord/noticebord-client-dotnet",
        registry: "NuGet",
        package: "https://github.com/noticebord/noticebord",
        command: "dotnet add package Noticebord.Client"
    },
    {
        id: "noticebord-php",
        platform: "PHP",
        icon: "devicon-php-plain",
        color: "#6181b6",
        source: "https://github.com/noticebord/noticebord-client-php",
        registry: "Packagist",
        package: "https://packagist.org/packages/noticebord/client",
        command: "composer require noticebord/client"
    },
    {
        id: "noticebord-go",
        platform: "Golang",
        icon: "devicon-go-plain",
        color: "#00acd7",
        registry: "pkg.go.dev",
        source: "https://github.com/noticebord/noticebord-client-go",
        package: "https://github.com/noticebord/noticebord",
        command: "go get github.com/noticebord/noticebord-client-go"
    }
]

export function getApps(): App[] {
    return apps;
}

export function getLibraries(): Library[] {
    return libraries;
}