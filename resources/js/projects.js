import React from 'react';
import { createRoot } from 'react-dom/client';
import ProjectList from './components/Projects/ProjectList';

const projectsRoot = document.getElementById('projects-root');

if (projectsRoot) {
    const root = createRoot(projectsRoot);
    root.render(<ProjectList />);
}