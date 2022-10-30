import React from 'react'
import BasicTabs from "../../../components/shared/Tabs/BasicTabs"
import TemplateArea from "../../../components/model/ClientResources/Templates/TemplateArea"
import CategoryArea from "../../../components/model/ClientResources/Categories/CategoryArea"

function Expenses() {

    return (
        <BasicTabs tabs={{
            Templates: <TemplateArea
                operationId={2}
                defaultCategoryId={2}
            />,
            Categories: <CategoryArea
                operationId={2}
            />
        }}/>
    )
}

export default Expenses