import React, { useState, useEffect } from 'react';
import axios from 'axios';
import ProjectCard from './ProjectCard.jsx';

const ProjectList = () => {
    const [projects, setProjects] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchProjects = async () => {
            try {
                setLoading(true);
                const response = await axios.get('/api/projects');
                setProjects(response.data);
                setLoading(false);
            } catch (err) {
                setError('Failed to fetch projects');
                setLoading(false);
            }
        };
        fetchProjects();
    }, []);

    if (loading) return <div>Loading...</div>;
    if (error) return <div>{error}</div>;

    return (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
            {projects.map((project) => (
                <ProjectCard 
                    key={project.id}
                    project={project}
                />
            ))}
        </div>
    );
};

export default ProjectList;