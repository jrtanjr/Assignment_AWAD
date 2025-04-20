import React from 'react';
import { Box, Typography, Chip } from '@mui/material';

const ProjectCard = ({ project }) => {
    return (
        <Box
            sx={{
                bgcolor: 'background.paper',
                borderRadius: 2,
                boxShadow: 1,
                p: 2,
                m: 1
            }}
        >
            <Typography variant="h6" gutterBottom>
                {project.title}
            </Typography>
            <Typography variant="body2" color="text.secondary" gutterBottom>
                {project.description}
            </Typography>
            <Box sx={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                <Typography variant="body2" color="text.secondary">
                    Budget: {project.budget}
                </Typography>
                <Chip
                    label={project.status}
                    color={project.status === 'Completed' ? 'success' : 'warning'}
                    size="small"
                />
            </Box>
        </Box>
    );
};

export default ProjectCard;