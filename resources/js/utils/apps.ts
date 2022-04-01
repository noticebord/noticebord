import { App, Library } from "../models";

const apps: App[] = [
    {
        id: "web",
        name: "Noticebord Web",
        description: "Use Noticebord on the web!",
        platforms: ["Web"],
        source: "https://github.com/noticebord/noticebord",
        cta: "Go to web app"
    },
    {
        id: "app",
        name: "Noticebord App",
        description: "Get the native app for your phone/PC.",
        platforms: ["Android", "iOS", "Windows", "macOS", "Linux"],
        source: "https://github.com/noticebord/app",
        cta: "Get Noticebord"
    },
    {
        id: "cli",
        name: "Noticebord CLI",
        description: "Use Noticebord from the terminal.",
        platforms: ["Windows", "macOS", "Linux"],
        source: "https://github.com/noticebord/cli",
        cta: "Get Noticebord CLI"
    },
    // {
    //     id: "bot",
    //     name: "Noticebort",
    //     description: "Have a chat with Noticebort in your favourite messaging app.",
    //     platforms: ["Telegram", "Discord"],
    //     source: "https://github.com/noticebord/bot",
    //     cta: "Chat with Noticebort"
    // },
    {
        id: "browser",
        name: "Noticebord Chrome Extension",
        description: "Create notices inside your favourite browser.",
        platforms: ["Chrome"],
        source: "https://github.com/noticebord/browser",
        cta: "Get the browser extension"
    },
    {
        id: "vscode",
        name: "Noticebord VS Code Extension",
        description: "Integrate Noticebord with your favourite editor.",
        platforms: ["VS Code"],
        source: "https://github.com/noticebord/code",
        cta: "Get the VS Code extension"
    }
]

const libraries: Library[] = [
    {
        id: "noticebord-ts",
        platform: "TypeScript",
        icon: "devicon-typescript-plain",
        color: "#007acc",
        source: "https://github.com/noticebord/client-ts",
        registry: "NPM",
        registryColor: "#cb3837",    
        registryIcon: "devicon-npm-original-wordmark",
        package: "https://github.com/noticebord/noticebord",
        command: "npm install @noticebord/client"
    },
    {
        id: "noticebord-dotnet",
        platform: ".NET",
        icon: "devicon-dotnetcore-plain",
        color: "#623697",
        source: "https://github.com/noticebord/client-dotnet",
        registry: "NuGet",
        registryColor: "#004880",
        registryIcon: "devicon-nuget-original",
        package: "https://github.com/noticebord/noticebord",
        command: "dotnet add package Noticebord.Client"
    },
    {
        id: "noticebord-dart",
        platform: "Dart",
        icon: "devicon-dart-plain",
        color: "#00a8e1",
        source: "https://github.com/noticebord/client-dart",
        registry: "pub.dev",
        registryColor: "#00a8e1",
        registryIcon: "devicon-dart-plain",
        package: "https://github.com/noticebord/noticebord",
        command: "dart pub get noticebord_client"
    },
    {
        id: "noticebord-flutter",
        platform: "Flutter",
        icon: "devicon-flutter-plain",
        color: "#3fb6d3",
        source: "https://github.com/noticebord/client-flutter",
        registry: "pub.dev",
        registryColor: "#3fb6d3",
        registryIcon: "devicon-flutter-plain",
        package: "https://github.com/noticebord/noticebord",
        command: "flutter pub get noticebord_client"
    },
    {
        id: "noticebord-php",
        platform: "PHP",
        icon: "devicon-php-plain",
        color: "#6181b6",
        source: "https://github.com/noticebord/client-php",
        registry: "Packagist",
        registryColor: "#6181b6",
        registryIcon: "devicon-php-plain",
        package: "https://packagist.org/packages/noticebord/client",
        command: "composer require noticebord/client"
    },
    {
        id: "noticebord-go",
        platform: "Golang",
        icon: "devicon-go-plain",
        color: "#00acd7",
        registry: "pkg.go.dev",
        registryColor: "#00acd7",
        registryIcon: "devicon-go-plain",
        source: "https://github.com/noticebord/client-go",
        package: "https://github.com/noticebord/noticebord",
        command: "go get github.com/noticebord/client-go"
    }
]

export function getApps(): App[] {
    return apps;
}

export function getLibraries(): Library[] {
    return libraries;
}